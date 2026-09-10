'use strict';
const { loadLatest } = require('../lib/youtube');
const snapshot = require('../data/predigten.json');
let cached = null;
let pending = null;
const TTL = 5 * 60 * 1000;

module.exports = async function handler(req, res) {
  res.setHeader('Access-Control-Allow-Origin', '*'); // Public metadata; also supports local file previews.
  res.setHeader('Access-Control-Allow-Methods', 'GET, HEAD, OPTIONS');
  res.setHeader('X-Content-Type-Options', 'nosniff');
  if (req.method === 'OPTIONS') return res.status(204).end();
  if (!['GET', 'HEAD'].includes(req.method)) {
    res.setHeader('Allow', 'GET, HEAD, OPTIONS');
    return res.status(405).json({ error: 'Method not allowed' });
  }
  try {
    if (!cached || Date.now() - Date.parse(cached.updatedAt) >= TTL) {
      if (!pending) pending = loadLatest().then(data => (cached = data)).finally(() => { pending = null; });
      await pending;
    }
    res.setHeader('Cache-Control', 'public, max-age=0, s-maxage=300, stale-while-revalidate=60');
    return res.status(200).json({ ...cached, stale: false });
  } catch (error) {
    console.error('Predigten refresh failed:', error.message);
    res.setHeader('Cache-Control', 'public, max-age=0, s-maxage=60');
    return res.status(200).json({ ...(cached || snapshot), stale: true });
  }
};
