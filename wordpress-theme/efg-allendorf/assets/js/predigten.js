/* Latest three completed YouTube videos. Shared by the static site and WordPress theme. */
(function () {
  'use strict';
  const section = document.querySelector('[data-predigten-endpoint]');
  if (!section) return;
  const list = section.querySelector('.predigten-list');
  const status = section.querySelector('[data-predigten-status]');
  const REFRESH_MS = 5 * 60 * 1000;
  let lastAttempt = 0;
  let loading = false;
  let updatedAt = section.dataset.predigtenUpdated;
  const dateFormat = new Intl.DateTimeFormat('de-DE', { timeZone: 'Europe/Berlin', day: '2-digit', month: '2-digit', year: 'numeric' });

  function staleNotice() {
    const date = new Date(updatedAt);
    status.textContent = 'Aktualisierung momentan nicht möglich.' + (Number.isFinite(date.getTime()) ? ' Stand: ' + dateFormat.format(date) + '.' : '') + ' Alle Videos findest du auf unserem YouTube-Kanal.';
  }

  function row(video) {
    const link = document.createElement('a');
    link.className = 'predigt-row';
    link.href = 'https://www.youtube.com/watch?v=' + video.id;
    link.target = '_blank';
    link.rel = 'noopener noreferrer';
    const play = document.createElement('span');
    play.className = 'predigt-play';
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('class', 'ico');
    svg.setAttribute('aria-hidden', 'true');
    const use = document.createElementNS('http://www.w3.org/2000/svg', 'use');
    use.setAttribute('href', '#i-play');
    svg.append(use);
    play.append(svg);
    const info = document.createElement('div');
    info.className = 'predigt-info';
    const title = document.createElement('strong');
    title.textContent = video.title;
    const action = document.createElement('span');
    action.textContent = 'Auf YouTube ansehen';
    info.append(title, action);
    const meta = document.createElement('div');
    meta.className = 'predigt-meta';
    const date = document.createElement('time');
    date.dateTime = video.recordedAt || video.publishedAt;
    date.textContent = dateFormat.format(new Date(date.dateTime));
    meta.append(date);
    if (video.recordedAt) {
      const dateLabel = document.createElement('span');
      dateLabel.textContent = 'Aufzeichnung';
      meta.append(dateLabel);
    }
    link.append(play, info, meta);
    return link;
  }

  async function refresh() {
    if (loading || (lastAttempt && Date.now() - lastAttempt < REFRESH_MS)) return;
    loading = true;
    lastAttempt = Date.now();
    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 25000);
    list.setAttribute('aria-busy', 'true');
    try {
      const response = await fetch(section.dataset.predigtenEndpoint, { signal: controller.signal, credentials: 'omit' });
      if (!response.ok) throw new Error('Feed request failed');
      const data = await response.json();
      if (data.channelId !== 'UCuJKSbQamH2tmewkiZJICmA' || !Array.isArray(data.videos) || data.videos.length !== 3) throw new Error('Invalid feed');
      const ids = new Set();
      for (const video of data.videos) {
        if (!/^[\w-]{11}$/.test(video.id) || ids.has(video.id) || typeof video.title !== 'string' || !video.title.trim() || !Number.isFinite(Date.parse(video.recordedAt || video.publishedAt))) throw new Error('Invalid video');
        ids.add(video.id);
      }
      // A failed refresh must never replace newer, already displayed videos with an old snapshot.
      if (data.stale && Date.parse(data.updatedAt) < Date.parse(updatedAt)) {
        staleNotice();
      } else {
        const rows = data.videos.map(row);
        const focused = list.querySelector('a:focus');
        const focusedId = focused ? new URL(focused.href).searchParams.get('v') : null;
        list.replaceChildren(...rows);
        if (focusedId) rows.find(a => new URL(a.href).searchParams.get('v') === focusedId)?.focus({ preventScroll: true });
        updatedAt = data.updatedAt;
        if (data.stale) staleNotice();
        else status.textContent = '';
      }
    } catch (_) {
      staleNotice();
    } finally {
      clearTimeout(timeout);
      list.setAttribute('aria-busy', 'false');
      loading = false;
    }
  }
  refresh();
  setInterval(() => { if (!document.hidden) refresh(); }, REFRESH_MS);
  document.addEventListener('visibilitychange', () => { if (!document.hidden) refresh(); });
})();
