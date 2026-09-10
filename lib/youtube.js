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
function parsePlayer(html) {
  const marker = /(?:var\s+)?ytInitialPlayerResponse\s*=\s*/g.exec(html);
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
  // Feed order is publication order; a completed livestream receives its publication date.
  for (let offset = 0; offset < entries.length && videos.length < 3; offset += 4) {
    const batch = await Promise.all(entries.slice(offset, offset + 4).map(async video => {
      const player = parsePlayer(await fetchText(video.url, fetchImpl));
      return completedVideo(video, player);
    }));
    videos.push(...batch.filter(Boolean));
  }
  if (videos.length < 3) throw new Error('Fewer than three verified videos');
  return { channelId: CHANNEL_ID, channelUrl: CHANNEL_URL, updatedAt: new Date().toISOString(), videos: videos.slice(0, 3) };
}

module.exports = { CHANNEL_ID, CHANNEL_URL, FEED_URL, parseFeed, parsePlayer, completedVideo, loadLatest };
