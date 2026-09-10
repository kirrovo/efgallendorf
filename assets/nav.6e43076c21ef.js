function getRelPath(e){return e===0?"./":"../".repeat(e)}const EFGA_ICON_SPRITE=`
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
    <symbol id="i-person" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4.5 20.5a7.5 7.5 0 0 1 15 0"/></symbol>
    <symbol id="i-chronik" viewBox="0 0 24 24"><polyline points="3 4.5 3 9.5 8 9.5"/><path d="M4.3 15.2a9 9 0 1 0 .9-7"/><polyline points="12 7.6 12 12 15.4 14"/></symbol>
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
    <symbol id="i-kirche" viewBox="0 0 24 24"><path d="M4.5 21V11.2L12 6.6l7.5 4.6V21"/><line x1="2.5" y1="21" x2="21.5" y2="21"/><line x1="12" y1="1.8" x2="12" y2="6.6"/><line x1="9.6" y1="3.6" x2="14.4" y2="3.6"/><path d="M10 21v-4.4a2 2 0 0 1 4 0V21"/></symbol>
    <symbol id="i-tasse" viewBox="0 0 24 24"><path d="M4 9h13v6.5a4.5 4.5 0 0 1-4.5 4.5h-4A4.5 4.5 0 0 1 4 15.5z"/><path d="M17 10.5h1.8a2.6 2.6 0 0 1 0 5.2H17"/><line x1="8" y1="2.6" x2="8" y2="5.6"/><line x1="12.5" y1="2.6" x2="12.5" y2="5.6"/></symbol>
    <symbol id="i-sonne" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4.2"/><line x1="12" y1="2.4" x2="12" y2="4.6"/><line x1="12" y1="19.4" x2="12" y2="21.6"/><line x1="2.4" y1="12" x2="4.6" y2="12"/><line x1="19.4" y1="12" x2="21.6" y2="12"/><line x1="5.2" y1="5.2" x2="6.8" y2="6.8"/><line x1="17.2" y1="17.2" x2="18.8" y2="18.8"/><line x1="5.2" y1="18.8" x2="6.8" y2="17.2"/><line x1="17.2" y1="6.8" x2="18.8" y2="5.2"/></symbol>
    <symbol id="i-note" viewBox="0 0 24 24"><circle cx="6.5" cy="17.5" r="2.8"/><circle cx="17.5" cy="15.5" r="2.8"/><line x1="9.3" y1="17.5" x2="9.3" y2="6.4"/><line x1="20.3" y1="15.5" x2="20.3" y2="4.4"/><path d="M9.3 8.4 20.3 6.4"/></symbol>
    <symbol id="i-lupe" viewBox="0 0 24 24"><circle cx="10.8" cy="10.8" r="6.8"/><line x1="15.8" y1="15.8" x2="20.6" y2="20.6"/></symbol>
    <symbol id="i-funke" viewBox="0 0 24 24"><path d="M11 3.2 12.6 8 17.4 9.6 12.6 11.2 11 16 9.4 11.2 4.6 9.6 9.4 8z"/><path d="M17.6 15.4 18.4 17.6 20.6 18.4 18.4 19.2 17.6 21.4 16.8 19.2 14.6 18.4 16.8 17.6z"/></symbol>
    <symbol id="i-youtube" viewBox="0 0 24 24"><path fill="currentColor" stroke="none" d="M21.6 7.2a2.5 2.5 0 0 0-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.5 2.5 0 0 0 2.4 7.2 26 26 0 0 0 2 12a26 26 0 0 0 .4 4.8 2.5 2.5 0 0 0 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4a2.5 2.5 0 0 0 1.8-1.8A26 26 0 0 0 22 12a26 26 0 0 0-.4-4.8zM10 15.1V8.9l5.2 3.1z"/></symbol>
  </defs>
</svg>`;function renderIcons(){document.getElementById("efga-icons")||document.body.insertAdjacentHTML("afterbegin",EFGA_ICON_SPRITE)}function ico(e,i){return`<svg class="ico ${i||""}" aria-hidden="true"><use href="#i-${e}"></use></svg>`}function renderNav(e,i){const t=getRelPath(i);if(renderIcons(),document.getElementById("site-header").dataset.rendered==="true"){initNavToggle(),decodeContacts();return}document.getElementById("site-header").innerHTML=`
    <div class="nav-inner">
      <a href="${t}index.html" class="logo">
        <img src="${t}bilder/logo.webp" width="364" height="116" alt="Evangelische Freie Gemeinde Allendorf, Startseite" />
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="hauptnavigation">
        ${ico("menue","ico-menue")}${ico("schliessen","ico-schliessen")}
        <span>Men\xFC</span>
      </button>
      <nav id="hauptnavigation" aria-label="Hauptnavigation">
        <a href="${t}index.html" ${e==="home"?'class="active" aria-current="page"':""}>Home</a>
        <a href="${t}wer-wir-sind.html" ${e==="wer"?'class="active" aria-current="page"':""}>Wer wir sind</a>
        <a href="${t}gruppen.html" ${e==="gruppen"?'class="active" aria-current="page"':""}>Gruppen</a>
        <a href="${t}gottesdienst-live.html" class="nav-live ${e==="live"?"active":""}" ${e==="live"?'aria-current="page"':""}>${ico("video","ico-sm")}Live</a>
      </nav>
    </div>`,initNavToggle(),decodeContacts(),window.efgaNavGleiten&&window.efgaNavGleiten()}function initNavToggle(){const e=document.querySelector(".nav-toggle"),i=document.getElementById("hauptnavigation");if(!e||!i)return;const t=()=>{e.setAttribute("aria-expanded","false"),i.classList.remove("offen")};e.addEventListener("click",()=>{const n=e.getAttribute("aria-expanded")==="true";e.setAttribute("aria-expanded",String(!n)),i.classList.toggle("offen",!n)}),i.addEventListener("click",n=>{n.target.closest("a")&&t()}),document.addEventListener("keydown",n=>{n.key==="Escape"&&e.getAttribute("aria-expanded")==="true"&&(t(),e.focus())})}function decodeContacts(){document.querySelectorAll(".ob-email").forEach(e=>{try{const i=atob(e.dataset.em);if(e.tagName==="A"){if(e.href="mailto:"+i,e.hasAttribute("data-label-behalten"))return;if(e.hasAttribute("data-nur-icon")){e.getAttribute("aria-label")||e.setAttribute("aria-label","E-Mail an "+i);return}e.childNodes.length>0?(e.childNodes.forEach(t=>{t.nodeType===3&&t.remove()}),e.appendChild(document.createTextNode(" "+i))):e.textContent=i}else e.textContent=i}catch{}}),document.querySelectorAll(".ob-tel").forEach(e=>{try{const i=atob(e.dataset.tel);if(e.tagName==="A"){if(e.href="tel:"+i.replace(/[\s\/]/g,""),e.hasAttribute("data-label-behalten"))return;e.childNodes.length>0?(e.childNodes.forEach(t=>{t.nodeType===3&&t.remove()}),e.appendChild(document.createTextNode(" "+i))):e.textContent=i}else e.textContent=i}catch{}})}document.addEventListener("DOMContentLoaded",decodeContacts);function renderFooter(e){if(document.getElementById("site-footer").dataset.rendered==="true")return;const i=getRelPath(e);document.getElementById("site-footer").innerHTML=`
    <div class="footer-karte">
      <div class="footer-inner">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-brand-kopf">
              ${ico("kirche")}
              <strong>EFG Allendorf</strong>
            </div>
            <p>Eine Gemeinschaft von Menschen, die Gott suchen und f\xFCreinander da sind, in Allendorf und Umgebung.</p>
          </div>

          <div class="footer-col">
            <h2>Gemeinde</h2>
            <a href="${i}wer-wir-sind.html">Wer wir sind</a>
            <a href="${i}wer-wir-sind.html#glaube">Glaubensbekenntnis</a>
            <a href="${i}wer-wir-sind.html#leitbild">Leitbild</a>
            <a href="${i}wer-wir-sind.html#chronik">Chronik</a>
          </div>

          <div class="footer-col">
            <h2>Angebote</h2>
            <a href="${i}gruppen.html">Gruppen</a>
            <a href="${i}index.html#predigten">Predigten</a>
            <a href="${i}index.html#kalender">Kalender</a>
          </div>

          <div class="footer-col">
            <h2>Kontakt</h2>
            <ul class="footer-kontakt">
              <li>${ico("ort")}<span>Heimlingstra\xDFe 3<br />35753 Greifenstein-Allendorf</span></li>
              <li>${ico("mail")}<a href="#" class="ob-email" data-em="aW5mb0BlZy1hbGxlbmRvcmYuZGU=" rel="nofollow"></a></li>
            </ul>
          </div>
        </div>

        <hr class="footer-trenner" />

        <div class="footer-bottom">
          <div class="footer-social">
            <a href="https://www.youtube.com/@efgallendorf" target="_blank" rel="noopener noreferrer" aria-label="Gemeinde auf YouTube">${ico("youtube")}</a>
            <a href="mailto:info@eg-allendorf.de" rel="nofollow" aria-label="E-Mail an die Gemeinde" title="E-Mail an info@eg-allendorf.de">${ico("mail")}</a>
          </div>
          <span>\xA9 ${new Date().getFullYear()} Evangelische Freie Gemeinde Allendorf</span>
          <div class="footer-rechtliches">
            <a href="${i}impressum.html">Impressum</a>
            <a href="${i}datenschutz.html">Datenschutzerkl\xE4rung</a>
          </div>
          <div class="footer-credit-row">
            <a class="footer-credit" href="mailto:info@kirrovo.marketing?body=Hallo%2C%0D%0AIch%20habe%20die%20Website%20von%20EFG%20Allendorf%20gesehen%20und%20w%C3%A4re%20auch%20an%20einer%20Zusammenarbeit%20interessiert%21%0D%0AIch%20bitte%20um%20R%C3%BCckmeldung.">Erstellt von kirrovo</a>
          </div>
        </div>
      </div>

    </div>`,decodeContacts()}document.addEventListener("DOMContentLoaded",()=>{document.body.hasAttribute("data-nav-active")&&(renderNav(document.body.dataset.navActive,Number(document.body.dataset.navDepth)),renderFooter(Number(document.body.dataset.navDepth)))});
