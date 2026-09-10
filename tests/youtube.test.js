'use strict';
const { test } = require('node:test');
const assert = require('node:assert/strict');
const { CHANNEL_ID, FEED_URL, parseFeed, parsePlayer, completedVideo, loadLatest } = require('../lib/youtube');
const ids = ['aaaaaaaaaaa', 'bbbbbbbbbbb', 'ccccccccccc', 'ddddddddddd'];
const entry = (id, day, title = 'Predigt &amp; Gebet') => `<entry><yt:videoId>${id}</yt:videoId><title>${title}</title><published>2026-09-0${day}T10:00:00Z</published></entry>`;
const feed = entries => `<feed><yt:channelId>${CHANNEL_ID}</yt:channelId>${entries}</feed>`;
const player = (id, changes = {}) => ({ videoDetails: { videoId: id, channelId: CHANNEL_ID, ...changes }, playabilityStatus: { status: 'OK' } });
const html = data => `var ytInitialPlayerResponse = ${JSON.stringify(data)};`;

test('feed decodes titles, sorts newest first, validates IDs and removes duplicates', () => {
  const result = parseFeed(feed(entry(ids[0], 1) + entry(ids[1], 4, 'M&#252;de &quot;Menschen&quot;') + entry('bad/id', 5) + entry(ids[0], 1)));
  assert.deepEqual(result.map(v => v.id), [ids[1], ids[0]]);
  assert.equal(result[0].title, 'Müde "Menschen"');
  assert.equal(result[1].title, 'Predigt & Gebet');
});

test('wrong channels and empty/malformed feeds fail instead of returning fake latest videos', () => {
  assert.throws(() => parseFeed('<html>upstream unavailable</html>'));
  assert.throws(() => parseFeed(feed('')));
});

test('player JSON remains data, including braces and semicolons inside titles', () => {
  const data = player(ids[0], { title: 'Text }; { "Zitat" <script>alert(1)</script>' });
  assert.deepEqual(parsePlayer(html(data)), data);
  assert.throws(() => parsePlayer('consent or bot page'));
});

test('future streams, active streams and unfinished recordings are excluded', () => {
  const video = { id: ids[0], publishedAt: '2026-09-01T10:00:00Z' };
  for (const changes of [{ isUpcoming: true }, { isLive: true }, { isLiveContent: true }]) {
    assert.equal(completedVideo(video, player(ids[0], changes)), null);
  }
  assert.throws(() => completedVideo(video, player(ids[1])));
  assert.equal(completedVideo({ ...video, publishedAt: '2099-01-01' }, player(ids[0])), null);
});

test('completed recordings retain broadcast date and ordinary videos are included', () => {
  const video = { id: ids[0], publishedAt: '2026-09-02T10:00:00Z' };
  const data = player(ids[0], { isLiveContent: true });
  data.microformat = { playerMicroformatRenderer: { liveBroadcastDetails: { startTimestamp: '2026-09-01T10:00:00Z', endTimestamp: '2026-09-01T11:00:00Z', isLiveNow: false } } };
  assert.equal(completedVideo(video, data).recordedAt, '2026-09-01T10:00:00Z');
  assert.equal(completedVideo(video, player(ids[0])).id, ids[0]);
});

test('refresh returns exactly three latest completed videos and skips a scheduled one', async () => {
  const fakeFetch = async url => ({ ok: true, text: async () => url === FEED_URL ? feed(ids.map((id, i) => entry(id, 4 - i)).join('')) : html(player(new URL(url).searchParams.get('v'), { isUpcoming: url.includes(ids[1]) })) });
  const result = await loadLatest(fakeFetch);
  assert.deepEqual(result.videos.map(v => v.id), [ids[0], ids[2], ids[3]]);
});

test('upstream errors fail a refresh so the handler can label cached results as stale', async () => {
  await assert.rejects(loadLatest(async () => ({ ok: false, status: 503 })));
});

test('API fallback is visibly marked stale and keeps a timestamp plus public CORS', async () => {
  const original = global.fetch;
  global.fetch = async () => { throw new Error('simulated outage'); };
  const handler = require('../api/predigten');
  const headers = {};
  const res = { setHeader: (k, v) => { headers[k] = v; }, status: code => { res.code = code; return res; }, json: data => { res.data = data; return res; } };
  try { await handler({ method: 'GET' }, res); } finally { global.fetch = original; }
  assert.equal(res.code, 200);
  assert.equal(res.data.stale, true);
  assert.equal(res.data.videos.length, 3);
  assert.ok(Date.parse(res.data.updatedAt));
  assert.equal(headers['Access-Control-Allow-Origin'], '*');
});

test('restricted watch pages use duration badges and exclude upcoming or live cards', async () => {
  const listing = { contents: ids.map((id, i) => ({ lockupViewModel: {
    contentId: id,
    contentImage: { thumbnailViewModel: { overlays: [{ thumbnailBottomOverlayViewModel: {
      badges: [{ thumbnailBadgeViewModel: { text: i === 1 ? 'UPCOMING' : '1:05:50' } }],
    } }] } },
  } })) };
  const fakeFetch = async url => ({ ok: true, text: async () => url === FEED_URL
    ? feed(ids.map((id, i) => entry(id, 4 - i)).join(''))
    : url.includes('/watch?') ? html({ playabilityStatus: { status: 'LOGIN_REQUIRED' } })
    : `var ytInitialData = ${JSON.stringify(listing)};` });
  const result = await loadLatest(fakeFetch);
  assert.deepEqual(result.videos.map(video => video.id), [ids[0], ids[2], ids[3]]);
});

test('unknown card metadata cannot silently drop newer videos', async () => {
  const fakeFetch = async url => ({ ok: true, text: async () => url === FEED_URL
    ? feed(ids.map((id, i) => entry(id, 4 - i)).join(''))
    : 'var ytInitialData = {"contents":[]};' });
  await assert.rejects(loadLatest(fakeFetch));
});
