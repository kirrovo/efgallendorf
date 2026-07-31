/* Gemeinsame Icons, Navigation & Footer, wird von allen Seiten eingebunden */

function getRelPath(depth) {
  return depth === 0 ? './' : '../'.repeat(depth);
}

/* ── Icon-Sprite ──────────────────────────────────────────────────────────
   Ein einziges Strich-Icon-Set (24er-Raster, stroke-width 1.6), Geometrie im
   Feather-Stil. Ersetzt die früheren Emojis. Verwendung im HTML:
     <svg class="ico" aria-hidden="true"><use href="#i-uhr"></use></svg>
──────────────────────────────────────────────────────────────────────── */
const EFGA_ICON_SPRITE = `
<svg id="efga-icons" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
  <defs>
    <symbol id="i-uhr" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 6.8 12 12 15.6 14.1"/></symbol>
    <symbol id="i-ort" viewBox="0 0 24 24"><path d="M12 21.5s7-6.4 7-11.3A7 7 0 1 0 5 10.2c0 4.9 7 11.3 7 11.3z"/><circle cx="12" cy="10" r="2.6"/></symbol>
    <symbol id="i-mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><polyline points="3.6 6.6 12 12.8 20.4 6.6"/></symbol>
    <symbol id="i-telefon" viewBox="0 0 24 24"><path d="M6.4 3.5h3l1.6 4-2 1.4a12.4 12.4 0 0 0 6.1 6.1l1.4-2 4 1.6v3a2 2 0 0 1-2.2 2A17.2 17.2 0 0 1 4.4 5.7a2 2 0 0 1 2-2.2z"/></symbol>
    <symbol id="i-kalender" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="8" y1="2.8" x2="8" y2="7"/><line x1="16" y1="2.8" x2="16" y2="7"/></symbol>
    <symbol id="i-buch" viewBox="0 0 24 24"><path d="M12 7.4C10.5 5.9 8 5.4 4 5.4V19c4 0 6.5.5 8 2 1.5-1.5 4-2 8-2V5.4c-4 0-6.5.5-8 2z"/><line x1="12" y1="7.4" x2="12" y2="21"/></symbol>
    <symbol id="i-herz" viewBox="0 0 24 24"><path d="M12 20.6 4.6 13.2a4.6 4.6 0 0 1 6.5-6.5l.9.9.9-.9a4.6 4.6 0 0 1 6.5 6.5z"/></symbol>
    <symbol id="i-personen" viewBox="0 0 24 24"><circle cx="9.2" cy="8" r="3.5"/><path d="M2.7 20a6.5 6.5 0 0 1 13 0"/><path d="M16.4 5.3a3.5 3.5 0 0 1 0 5.4"/><path d="M17.6 14.4a6.5 6.5 0 0 1 3.8 5.6"/></symbol>
    <symbol id="i-chronik" viewBox="0 0 24 24"><polyline points="3 4.5 3 9.5 8 9.5"/><path d="M4.3 15.2a9 9 0 1 0 .9-7"/><polyline points="12 7.6 12 12 15.4 14"/></symbol>
    <symbol id="i-schloss" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></symbol>
    <symbol id="i-play" viewBox="0 0 24 24"><path d="M9 6.4 18 12l-9 5.6z"/></symbol>
    <symbol id="i-pfeil-rechts" viewBox="0 0 24 24"><line x1="4" y1="12" x2="19" y2="12"/><polyline points="13 6 19 12 13 18"/></symbol>
    <symbol id="i-pfeil-links" viewBox="0 0 24 24"><line x1="20" y1="12" x2="5" y2="12"/><polyline points="11 6 5 12 11 18"/></symbol>
    <symbol id="i-menue" viewBox="0 0 24 24"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></symbol>
    <symbol id="i-schliessen" viewBox="0 0 24 24"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></symbol>
    <symbol id="i-haus" viewBox="0 0 24 24"><path d="M3.5 10.4 12 3.4l8.5 7V20a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 20z"/><polyline points="9.5 21.5 9.5 14.4 14.5 14.4 14.5 21.5"/></symbol>
    <symbol id="i-kompass" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M15.6 8.4 13.4 13.4 8.4 15.6 10.6 10.6z"/></symbol>
    <symbol id="i-stern" viewBox="0 0 24 24"><path d="m12 3.4 2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17.4l-5.4 2.9 1-6.1L3.2 9.9l6.1-.9z"/></symbol>
    <symbol id="i-pflanze" viewBox="0 0 24 24"><line x1="12" y1="21" x2="12" y2="13.6"/><path d="M12 13.6C12 8.8 8.2 6.4 4 6.4c0 4.8 3.8 7.2 8 7.2z"/><path d="M12 13.6c0-4 3.4-6.4 7-6.4 0 4.4-3.4 6.4-7 6.4z"/></symbol>
    <symbol id="i-notiz" viewBox="0 0 24 24"><path d="M4 20h4L18.6 9.4a2.1 2.1 0 0 0-3-3L5 17z"/><line x1="14.6" y1="6.4" x2="17.6" y2="9.4"/></symbol>
    <symbol id="i-video" viewBox="0 0 24 24"><rect x="3" y="6" width="13.5" height="12" rx="2"/><path d="m16.5 11 4.5-2.6v7.2L16.5 13z"/></symbol>
    <symbol id="i-youtube" viewBox="0 0 24 24"><path fill="currentColor" stroke="none" d="M21.6 7.2a2.5 2.5 0 0 0-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.5 2.5 0 0 0 2.4 7.2 26 26 0 0 0 2 12a26 26 0 0 0 .4 4.8 2.5 2.5 0 0 0 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4a2.5 2.5 0 0 0 1.8-1.8A26 26 0 0 0 22 12a26 26 0 0 0-.4-4.8zM10 15.1V8.9l5.2 3.1z"/></symbol>
  </defs>
</svg>`;

function renderIcons() {
  if (document.getElementById('efga-icons')) return;
  document.body.insertAdjacentHTML('afterbegin', EFGA_ICON_SPRITE);
}

/** Kurzform für ein Icon im Markup. */
function ico(name, extra) {
  return `<svg class="ico ${extra || ''}" aria-hidden="true"><use href="#i-${name}"></use></svg>`;
}

function renderNav(activePage, depth) {
  const r = getRelPath(depth);
  renderIcons();

  document.getElementById('site-header').innerHTML = `
    <div class="nav-inner">
      <a href="${r}index.html" class="logo">
        <img src="${r}efga-logo_new-e1520008237499.png" alt="Evangelische Freie Gemeinde Allendorf, Startseite" />
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="hauptnavigation">
        ${ico('menue', 'ico-menue')}${ico('schliessen', 'ico-schliessen')}
        <span>Menü</span>
      </button>
      <nav id="hauptnavigation" aria-label="Hauptnavigation">
        <a href="${r}index.html" ${activePage === 'home' ? 'class="active" aria-current="page"' : ''}>Home</a>
        <a href="${r}wer-wir-sind.html" ${activePage === 'wer' ? 'class="active" aria-current="page"' : ''}>Wer wir sind</a>
        <a href="${r}gruppen.html" ${activePage === 'gruppen' ? 'class="active" aria-current="page"' : ''}>Gruppen</a>
        <a href="${r}gottesdienst-live.html" class="nav-live ${activePage === 'live' ? 'active' : ''}" ${activePage === 'live' ? 'aria-current="page"' : ''}>${ico('video', 'ico-sm')}Live</a>
        <a href="${r}index.html#kalender" ${activePage === 'kalender' ? 'class="active" aria-current="page"' : ''}>Kalender</a>
        <a href="${r}intern.html" class="nav-intern">${ico('schloss', 'ico-sm')}Intern</a>
      </nav>
    </div>`;

  initNavToggle();
  decodeContacts();
}

/** Mobil-Menü: Disclosure-Muster, tastaturbedienbar. */
function initNavToggle() {
  const toggle = document.querySelector('.nav-toggle');
  const menu = document.getElementById('hauptnavigation');
  if (!toggle || !menu) return;

  const schliessen = () => {
    toggle.setAttribute('aria-expanded', 'false');
    menu.classList.remove('offen');
  };

  toggle.addEventListener('click', () => {
    const offen = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!offen));
    menu.classList.toggle('offen', !offen);
  });

  menu.addEventListener('click', (e) => {
    if (e.target.closest('a')) schliessen();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      schliessen();
      toggle.focus();
    }
  });
}

/* ── Webcrawler-Schutz für E-Mails & Telefonnummern ──────────────────────
   Kontaktdaten werden als base64-kodierte data-Attribute gespeichert und
   erst per JS zusammengesetzt, unsichtbar für automatische Crawler.
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
          <p>Eine Gemeinschaft von Menschen, die Gott suchen und füreinander da sind, in Allendorf und Umgebung.</p>
        </div>
        <div class="footer-col">
          <h4>Gemeinde</h4>
          <a href="${r}wer-wir-sind.html">Wer wir sind</a>
          <a href="${r}wer-wir-sind.html#glaube">Glaubensbekenntnis</a>
          <a href="${r}wer-wir-sind.html#leitbild">Leitbild</a>
          <a href="${r}wer-wir-sind.html#chronik">Chronik</a>
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
        <span>© ${new Date().getFullYear()} Evangelische Freie Gemeinde Allendorf</span>
        <div style="display:flex;gap:18px;">
          <a href="${r}impressum.html">Impressum</a>
          <a href="${r}datenschutz.html">Datenschutzerklärung</a>
        </div>
      </div>
    </div>`;
}
