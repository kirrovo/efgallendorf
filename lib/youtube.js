'use strict';

const CHANNEL_ID = 'UCuJKSbQamH2tmewkiZJICmA';
const CHANNEL_URL = 'https://www.youtube.com/@efgallendorf';
const FEED_URL = `https://www.youtube.com/feeds/videos.xml?channel_id=${CHANNEL_ID}`;

function decodeXml(text) {
  return text.replace(/<!\[CDATA\[([\s\S]*?)\]\]>/g, '$1').replace(/&(#x[0-9a-f]+|#\d+|amp|lt|gt|quot|apos);/gi, (match, entity) => {
    const named = { amp: '&', lt: '<', gt: '>', quot: '"', apos: "'" };
    if (named[entity]) return named[entity];
    const value = entity.startsWith('#x') ? parseInt(entity.slice(2), 16) : parseInt(entity.slice(1), 10);
    return value > 0 && value <= 0x10ffff ? String.fromCodePoint(value) : match;
  });
}

function parseFeed(xml) {
  if (!xml.includes(`<yt:channelId>${CHANNEL_ID}</yt:channelId>`)) throw new Error('Unexpected channel');
  const videos = new Map();
  for (const match of xml.matchAll(/<entry>([\s\S]*?)<\/entry>/g)) {
    const read = tag => decodeXml(match[1].match(new RegExp(`<${tag}>([\\s\\S]*?)<\\/${tag}>`))?.[1] || '').trim();
    const id = read('yt:videoId');
    const title = read('title').replace(/\s+/g, ' ');
    const publishedAt = read('published');
    if (/^[\w-]{11}$/.test(id) && title && Number.isFinite(Date.parse(publishedAt))) {
      videos.set(id, { id, title, publishedAt, url: `https://www.youtube.com/watch?v=${id}` });
    }
  }
  if (!videos.size) throw new Error('Empty YouTube feed');
  return [...videos.values()].sort((a, b) => Date.parse(b.publishedAt) - Date.parse(a.publishedAt));
}

// Read JSON as data, never execute scripts returned by YouTube.
function parseAssignedJson(html, name) {
  const marker = new RegExp(`(?:var\\s+)?${name}\\s*=\\s*`).exec(html);
  if (!marker) throw new Error('Missing video metadata');
  const start = marker.index + marker[0].length;
  let depth = 0, quoted = false, escaped = false;
  for (let i = start; i < html.length; i++) {
    const char = html[i];
    if (quoted) {
      if (escaped) escaped = false;
      else if (char === '\\') escaped = true;
      else if (char === '"') quoted = false;
    } else if (char === '"') quoted = true;
    else if (char === '{') depth++;
    else if (char === '}' && --depth === 0) return JSON.parse(html.slice(start, i + 1));
  }
  throw new Error('Invalid video metadata');
}

function parsePlayer(html) {
  return parseAssignedJson(html, 'ytInitialPlayerResponse');
}

function parseListing(html) {
  const data = parseAssignedJson(html, 'ytInitialData');
  const states = new Map();
  const duration = text => /^\d+(?::\d{2}){1,2}$/.test(text || '');
  function visit(value) {
    if (!value || typeof value !== 'object') return;
    const card = value.lockupViewModel;
    if (card && /^[\w-]{11}$/.test(card.contentId || '')) {
      const badges = card.contentImage?.thumbnailViewModel?.overlays
        ?.flatMap(overlay => overlay.thumbnailBottomOverlayViewModel?.badges || [])
        .map(badge => badge.thumbnailBadgeViewModel?.text) || [];
      if (badges.length) states.set(card.contentId, badges.some(duration));
    }
    const legacy = value.videoRenderer;
    if (legacy && /^[\w-]{11}$/.test(legacy.videoId || '')) {
      const overlays = legacy.thumbnailOverlays?.map(overlay => overlay.thumbnailOverlayTimeStatusRenderer).filter(Boolean) || [];
      const blocked = legacy.upcomingEventData || overlays.some(overlay => ['LIVE', 'UPCOMING'].includes(overlay.style));
      const length = legacy.lengthText?.simpleText || legacy.lengthText?.runs?.map(run => run.text).join('');
      if (blocked || length) states.set(legacy.videoId, !blocked && duration(length));
    }
    for (const child of Object.values(value)) visit(child);
  }
  visit(data);
  return states;
}

function completedVideo(video, player, now = Date.now()) {
  const details = player.videoDetails;
  if (!details || details.videoId !== video.id || details.channelId !== CHANNEL_ID) throw new Error('Unverified video');
  const broadcast = player.microformat?.playerMicroformatRenderer?.liveBroadcastDetails;
  if (details.isUpcoming || details.isLive || broadcast?.isLiveNow) return null;
  if (details.isLiveContent && !broadcast?.endTimestamp) return null;
  if (Date.parse(video.publishedAt) > now) return null;
  if (player.playabilityStatus?.status !== 'OK') throw new Error('Video unavailable');
  const recordedAt = broadcast?.startTimestamp;
  return { ...video, ...(recordedAt && Number.isFinite(Date.parse(recordedAt)) ? { recordedAt } : {}) };
}

async function fetchText(url, fetchImpl) {
  const response = await fetchImpl(url, {
    signal: AbortSignal.timeout(8000),
    headers: { 'User-Agent': 'Mozilla/5.0', 'Accept-Language': 'de-DE,de;q=0.9' },
  });
  if (!response.ok) throw new Error(`YouTube HTTP ${response.status}`);
  const text = await response.text();
  if (text.length > 5000000) throw new Error('Oversized YouTube response');
  return text;
}

async function loadLatest(fetchImpl = fetch) {
  const entries = parseFeed(await fetchText(FEED_URL, fetchImpl));
  const videos = [];
  let listingPromise;
  const listingStates = () => listingPromise ||= Promise.allSettled(
    ['streams', 'videos'].map(async tab => parseListing(await fetchText(`${CHANNEL_URL}/${tab}?hl=en`, fetchImpl)))
  ).then(results => new Map(results.filter(result => result.status === 'fulfilled').flatMap(result => [...result.value])));
  // Feed order is publication order. Public channel cards are a fallback when
  // YouTube restricts watch-page metadata from hosting-provider networks.
  for (let offset = 0; offset < entries.length && videos.length < 3; offset += 4) {
    const batch = await Promise.all(entries.slice(offset, offset + 4).map(async video => {
      if (Date.parse(video.publishedAt) > Date.now()) return null;
      try {
        return completedVideo(video, parsePlayer(await fetchText(video.url, fetchImpl)));
      } catch (error) {
        const states = await listingStates();
        if (!states.has(video.id)) throw error; // Unknown is never treated as completed.
        return states.get(video.id) ? video : null;
      }
    }));
    videos.push(...batch.filter(Boolean));
  }
  if (videos.length < 3) throw new Error('Fewer than three verified videos');
  return { channelId: CHANNEL_ID, channelUrl: CHANNEL_URL, updatedAt: new Date().toISOString(), videos: videos.slice(0, 3) };
}

module.exports = { CHANNEL_ID, CHANNEL_URL, FEED_URL, parseFeed, parsePlayer, parseListing, completedVideo, loadLatest };
