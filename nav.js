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
        <a href="${r}index.html#kalender" ${activePage==='kalender'?'class="active"':''}>Kalender</a>
        <a href="${r}intern.html" class="nav-intern">🔒 Intern</a>
      </nav>
    </div>`;
  // Decode obfuscated contacts after nav render
  decodeContacts();
}

/* ── Webcrawler-Schutz für E-Mails & Telefonnummern ──────────────────────
   Kontaktdaten werden als base64-kodierte data-Attribute gespeichert und
   erst per JS zusammengesetzt – unsichtbar für automatische Crawler.
   Verwendung im HTML:
     E-Mail:  <a class="ob-email" data-em="base64..."></a>
     Telefon: <a class="ob-tel"   data-tel="base64..."></a>
     Text:    <span class="ob-email" data-em="base64..."></span>
              <span class="ob-tel"   data-tel="base64..."></span>
──────────────────────────────────────────────────────────────────────── */
function decodeContacts() {
  document.querySelectorAll('.ob-email').forEach(el => {
    try {
      const addr = atob(el.dataset.em);
      if (el.tagName === 'A') {
        el.href = 'mailto:' + addr;
        // If element has child nodes (e.g. SVG icon), append text after them
        if (el.childNodes.length > 0) {
          // Remove any existing text nodes first
          el.childNodes.forEach(n => { if (n.nodeType === 3) n.remove(); });
          el.appendChild(document.createTextNode(' ' + addr));
        } else {
          el.textContent = addr;
        }
      } else {
        el.textContent = addr;
      }
    } catch(e) {}
  });
  document.querySelectorAll('.ob-tel').forEach(el => {
    try {
      const num = atob(el.dataset.tel);
      if (el.tagName === 'A') {
        el.href = 'tel:' + num.replace(/[\s\/]/g, '');
        if (el.childNodes.length > 0) {
          el.childNodes.forEach(n => { if (n.nodeType === 3) n.remove(); });
          el.appendChild(document.createTextNode(' ' + num));
        } else {
          el.textContent = num;
        }
      } else {
        el.textContent = num;
      }
    } catch(e) {}
  });
}
// Also decode on DOMContentLoaded for inline scripts that call decodeContacts early
document.addEventListener('DOMContentLoaded', decodeContacts);

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
