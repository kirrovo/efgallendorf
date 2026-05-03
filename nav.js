/* Gemeinsame Navigation & Footer – wird von allen Seiten eingebunden */

function getRelPath(depth) {
  return depth === 0 ? './' : '../'.repeat(depth);
}

function renderNav(activePage, depth) {
  const r = getRelPath(depth);
  document.getElementById('site-header').innerHTML = `
    <div class="nav-inner">
      <a href="${r}index.html" class="logo">
        <img src="${r}efga-logo_new-e1520008237499.png" alt="Evangelische Freie Gemeinde Allendorf" style="height:44px;width:auto;display:block;" />
      </a>
      <nav>
        <a href="${r}index.html" ${activePage==='home'?'class="active"':''}>Home</a>
        <a href="${r}wer-wir-sind.html" ${activePage==='wer'?'class="active"':''}>Wer wir sind</a>
        <a href="${r}gruppen.html" ${activePage==='gruppen'?'class="active"':''}>Gruppen</a>
        <a href="${r}gottesdienst-live.html" ${activePage==='live'?'class="active"':''} style="color:#e53935;font-weight:700;">🔴 Live</a>
        <a href="${r}intern.html" class="nav-intern">🔒 Intern</a>
      </nav>
    </div>`;
}

function renderFooter(depth) {
  const r = getRelPath(depth);
  document.getElementById('site-footer').innerHTML = `
    <div class="footer-inner">
      <div class="footer-grid">
        <div class="footer-brand">
          <strong>Evangelische Freie Gemeinde Allendorf</strong>
          <p>Eine Gemeinschaft von Menschen, die Gott suchen und füreinander da sind – in Allendorf und Umgebung.</p>
        </div>
        <div class="footer-col">
          <h4>Gemeinde</h4>
          <a href="${r}index.html#wer-wir-sind">Wer wir sind</a>
          <a href="${r}index.html#wer-wir-sind">Glaubensbekenntnis</a>
          <a href="${r}index.html#wer-wir-sind">Leitbild</a>
          <a href="${r}index.html#wer-wir-sind">Chronik</a>
        </div>
        <div class="footer-col">
          <h4>Angebote</h4>
          <a href="${r}index.html#veranstaltungen">Veranstaltungen</a>
          <a href="${r}gruppen.html">Gruppen</a>
          <a href="${r}index.html#predigten">Predigten</a>
          <a href="${r}index.html#kalender">Kalender</a>
        </div>
        <div class="footer-col">
          <h4>Mehr</h4>
          <a href="${r}index.html#kontakt">Kontakt</a>
          <a href="${r}intern.html">Interner Bereich</a>
          <a href="${r}impressum.html">Impressum</a>
          <a href="${r}datenschutz.html">Datenschutz</a>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© 2026 Evangelische Freie Gemeinde Allendorf</span>
        <div style="display:flex;gap:16px;">
          <a href="${r}impressum.html">Impressum</a>
          <a href="${r}datenschutz.html">Datenschutzerklärung</a>
        </div>
      </div>
    </div>`;
}
