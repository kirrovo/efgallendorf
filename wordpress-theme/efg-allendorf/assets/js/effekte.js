/* Interaktive Elemente: Kartenfächer, Kartenneigung, Navigation.
   Ohne Framework, ohne externe Bibliothek. Dekorative Bewegung entfällt bei reduzierter Bewegung;
   die Slider-Bedienung bleibt vollständig verfügbar. */
(function () {
  'use strict';

  var wenigerBewegung = window.matchMedia('(prefers-reduced-motion: reduce)');

  /* Ruhiger Kartenfächer: eine aktive Karte, Nachbarn als Vorschau.
     Ohne JavaScript bleibt die vollständige Bildreihe scrollbar. */
  function faecherStarten(wurzel) {
    var buehne = wurzel.querySelector('.faecher-buehne');
    var karten = Array.prototype.slice.call(wurzel.querySelectorAll('.faecher-karte'));
    var status = wurzel.querySelector('.faecher-status');
    if (!buehne || !karten.length) return;
    var mitte = 0;
    var start = null;
    var klickSperreBis = 0;
    wurzel.classList.add('faecher-bereit');
    wurzel.setAttribute('aria-roledescription', 'Karussell');

    function zeichnen() {
      var breite = karten[0].offsetWidth;
      var nachbarn = buehne.clientWidth < 640 ? 1 : 2;
      karten.forEach(function (karte, i) {
        var d = (i - mitte + karten.length) % karten.length;
        if (d > karten.length / 2) d -= karten.length;
        var abstand = Math.abs(d);
        var sichtbar = abstand <= nachbarn;
        var seite = Math.sign(d);
        karte.style.setProperty('--fx', seite * Math.min(abstand, 3) * breite * .68 + 'px');
        karte.style.setProperty('--fy', Math.min(abstand, 3) * 16 + 'px');
        karte.style.setProperty('--frot', seite * Math.min(abstand, 3) * 5 + 'deg');
        karte.style.setProperty('--fscale', 1 - Math.min(abstand, 3) * .1);
        karte.style.setProperty('--fop', sichtbar ? 1 : 0);
        karte.style.zIndex = 10 - abstand;
        karte.classList.toggle('ist-aktiv', d === 0);
        karte.classList.toggle('ist-sichtbar', sichtbar);
        karte.style.pointerEvents = sichtbar ? 'auto' : 'none';
        karte.setAttribute('aria-hidden', d === 0 ? 'false' : 'true');
        karte.tabIndex = d === 0 ? 0 : -1;
      });
      if (status) status.textContent = String(mitte + 1).padStart(2, '0') + ' / ' + String(karten.length).padStart(2, '0');
    }

    function wechseln(index) {
      var fokusAufKarte = karten.indexOf(document.activeElement) !== -1;
      mitte = (index + karten.length) % karten.length;
      zeichnen();
      if (fokusAufKarte) karten[mitte].focus({ preventScroll: true });
    }
    wurzel.querySelectorAll('.faecher-pfeil').forEach(function (button) {
      button.disabled = karten.length < 2;
      button.addEventListener('click', function () {
        wechseln(mitte + (button.dataset.richtung === 'rechts' ? 1 : -1));
      });
    });
    karten.forEach(function (karte, i) {
      karte.draggable = false;
      var bild = karte.querySelector('img');
      if (bild) bild.draggable = false;
      karte.addEventListener('click', function (event) {
        if (Date.now() < klickSperreBis) { event.preventDefault(); return; }
        if (i !== mitte) { event.preventDefault(); wechseln(i); }
      });
    });
    wurzel.addEventListener('keydown', function (event) {
      if (event.altKey || event.ctrlKey || event.metaKey) return;
      if (event.key === 'ArrowLeft') wechseln(mitte - 1);
      else if (event.key === 'ArrowRight') wechseln(mitte + 1);
      else if (event.key === 'Home') wechseln(0);
      else if (event.key === 'End') wechseln(karten.length - 1);
      else return;
      event.preventDefault();
    });

    // Horizontal wischen oder ziehen; vertikales Scrollen bleibt dem Browser.
    buehne.addEventListener('pointerdown', function (event) {
      if (!event.isPrimary || event.button !== 0) return;
      start = { x: event.clientX, y: event.clientY, id: event.pointerId, zieht: false };
    });
    buehne.addEventListener('pointermove', function (event) {
      if (!start || start.id !== event.pointerId) return;
      var dx = event.clientX - start.x, dy = event.clientY - start.y;
      if (Math.abs(dx) > 12 && Math.abs(dx) > Math.abs(dy) * 1.25) {
        start.zieht = true;
        buehne.setPointerCapture(event.pointerId);
      }
    });
    function loslassen(event) {
      if (!start || start.id !== event.pointerId) return;
      var dx = event.clientX - start.x, dy = event.clientY - start.y;
      if (start.zieht) {
        klickSperreBis = Date.now() + 400;
        if (event.type === 'pointerup' && Math.abs(dx) > 45 && Math.abs(dx) > Math.abs(dy) * 1.25) {
          wechseln(mitte + (dx < 0 ? 1 : -1));
        }
      }
      start = null;
      if (buehne.hasPointerCapture(event.pointerId)) buehne.releasePointerCapture(event.pointerId);
    }
    buehne.addEventListener('pointerup', loslassen);
    buehne.addEventListener('pointercancel', loslassen);
    window.addEventListener('pointerup', function () { start = null; });
    new ResizeObserver(zeichnen).observe(buehne);
    zeichnen();
  }

  /* ── Gleitender Text in der Navigation ────────────────────────────
     Die Vorlage hinterlegt jeden Link doppelt. Statt das im Markup zu
     verdoppeln, baut das Skript die zweite Kopie zur Laufzeit ein.
     Läuft für beide Varianten: statisches HTML und wp_nav_menu.
  ──────────────────────────────────────────────────────────────── */
  function navGleitenStarten() {
    if (wenigerBewegung.matches) return;
    var links = document.querySelectorAll('#hauptnavigation a');
    Array.prototype.forEach.call(links, function (a) {
      // Nach dem Seitenwechsel bleibt der aktive Menüpunkt ruhig, auch
      // wenn der Mauszeiger noch über dem gerade angeklickten Link steht.
      if (a.matches('.active, [aria-current="page"]') ||
          a.closest('.current-menu-item, .current_page_item')) return;
      if (a.querySelector('.nav-gleit')) return;
      // Nur reine Textknoten ersetzen, Icons bleiben unangetastet
      Array.prototype.slice.call(a.childNodes).forEach(function (knoten) {
        if (knoten.nodeType !== 3) return;
        var text = knoten.textContent;
        if (!text.trim()) return;
        var huelle = document.createElement('span');
        huelle.className = 'nav-gleit';
        huelle.setAttribute('aria-hidden', 'false');
        var a1 = document.createElement('span');
        var a2 = document.createElement('span');
        a1.textContent = text.trim();
        a2.textContent = text.trim();
        a2.setAttribute('aria-hidden', 'true');
        huelle.appendChild(a1);
        huelle.appendChild(a2);
        a.replaceChild(huelle, knoten);
      });
    });
  }

  // Die statische Navigation wird per JS gerendert, daher auch nachziehen
  window.efgaNavGleiten = navGleitenStarten;


  /* ── Restzeit auf den Wochenkarten ────────────────────────────────
     Die Vorlage zeigt an dieser Stelle "2 days left". Hier wird der
     Wert aus dem heutigen Wochentag berechnet, statt ihn zu setzen.
     Die naechste anstehende Karte wird hervorgehoben.
  ──────────────────────────────────────────────────────────────── */
  function wochenRestzeit() {
    var karten = document.querySelectorAll('.woche-karte[data-wochentag]');
    if (!karten.length) return;

    var heute = new Date().getDay();   // 0 = Sonntag
    var kleinster = 8, naechste = null;

    Array.prototype.forEach.call(karten, function (karte) {
      var tag = parseInt(karte.dataset.wochentag, 10);
      var abstand = (tag - heute + 7) % 7;
      var feld = karte.querySelector('[data-restzeit]');
      if (feld) {
        feld.textContent = abstand === 0 ? 'heute'
                         : abstand === 1 ? 'morgen'
                         : 'in ' + abstand + ' Tagen';
      }
      karte.classList.remove('betont');
      if (abstand < kleinster) { kleinster = abstand; naechste = karte; }
    });

    if (naechste) { naechste.classList.add('betont'); }
  }

  document.addEventListener('DOMContentLoaded', function () {
    wochenRestzeit();
    navGleitenStarten();
    setTimeout(navGleitenStarten, 0);
    document.querySelectorAll('[data-faecher]').forEach(function (el) {
      faecherStarten(el);
    });
  });
})();
