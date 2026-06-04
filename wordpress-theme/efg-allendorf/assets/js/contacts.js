/* ── Webcrawler-Schutz für E-Mails & Telefonnummern ──────────────────────
   Kontaktdaten werden als base64-kodierte data-Attribute gespeichert und
   erst per JS zusammengesetzt – unsichtbar für automatische Crawler.
   Verwendung im HTML:
     E-Mail:  <a class="ob-email" data-em="base64..."></a>
     Telefon: <a class="ob-tel"   data-tel="base64..."></a>
     Text:    <span class="ob-email" data-em="base64..."></span>
              <span class="ob-tel"   data-tel="base64..."></span>
──────────────────────────────────────────────────────────────────────── */
(function () {
  function decodeContacts() {
    document.querySelectorAll('.ob-email').forEach(function (el) {
      try {
        var addr = atob(el.dataset.em);
        if (el.tagName === 'A') {
          el.href = 'mailto:' + addr;
          if (el.childNodes.length > 0) {
            el.childNodes.forEach(function (n) { if (n.nodeType === 3) n.remove(); });
            el.appendChild(document.createTextNode(' ' + addr));
          } else {
            el.textContent = addr;
          }
        } else {
          el.textContent = addr;
        }
      } catch (e) {}
    });
    document.querySelectorAll('.ob-tel').forEach(function (el) {
      try {
        var num = atob(el.dataset.tel);
        if (el.tagName === 'A') {
          el.href = 'tel:' + num.replace(/[\s\/]/g, '');
          if (el.childNodes.length > 0) {
            el.childNodes.forEach(function (n) { if (n.nodeType === 3) n.remove(); });
            el.appendChild(document.createTextNode(' ' + num));
          } else {
            el.textContent = num;
          }
        } else {
          el.textContent = num;
        }
      } catch (e) {}
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', decodeContacts);
  } else {
    decodeContacts();
  }
})();
