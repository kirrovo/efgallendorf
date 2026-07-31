/* Interaktive Elemente: Kartenfächer und Spotlight.
   Ohne Framework, ohne externe Bibliothek. Beide Effekte schalten sich
   ab, wenn der Nutzer reduzierte Bewegung eingestellt hat. */
(function () {
  'use strict';

  var wenigerBewegung = window.matchMedia('(prefers-reduced-motion: reduce)');

  /* ── Kartenfächer ─────────────────────────────────────────────────
     Positionen und Reihenfolge entsprechen der Vorlage: sieben
     sichtbare Karten, die mittlere vorne, die äußeren gedreht und
     verkleinert. Statt GSAP übernehmen CSS-Transitions das Weiche.
  ──────────────────────────────────────────────────────────────── */
  var SICHTBAR = 7;
  var HAELFTE = 3;

  var PLAETZE = [
    { rot: -21, scale: 0.7756, x: -30, y: 7.3, z: 1 },
    { rot: -14, scale: 0.8498, x: -22, y: 4.0, z: 2 },
    { rot: -7,  scale: 0.9346, x: -11, y: 1.3, z: 3 },
    { rot: 0,   scale: 1.0,    x: 0,   y: 0.0, z: 10 },
    { rot: 7,   scale: 0.9346, x: 11,  y: 1.3, z: 3 },
    { rot: 14,  scale: 0.8498, x: 22,  y: 4.0, z: 2 },
    { rot: 21,  scale: 0.7756, x: 30,  y: 7.3, z: 1 }
  ];

  function breitenFaktor(b) {
    if (b < 480) return 0.28;
    if (b < 640) return 0.38;
    if (b < 768) return 0.5;
    if (b < 1024) return 0.75;
    return 1.0;
  }

  /** Kürzt die Höhenversätze, wenn der Bildschirm flach ist. */
  function hoehenFaktor(b) {
    var ideal = b < 480 ? 352 : b < 640 ? 416 : b < 768 ? 448 : b < 1024 ? 544 : 608;
    var da = window.innerHeight * 0.7;
    return da >= ideal ? 1 : da / ideal;
  }

  /** Platzwerte für Fächer mit weniger als sieben Karten. */
  function platz(anzahl, slot) {
    if (anzahl >= SICHTBAR) return PLAETZE[slot];
    var mitte = anzahl >> 1;
    var d = anzahl > 1 ? (slot - mitte) / mitte : 0;
    var ad = Math.abs(d);
    return {
      rot: d * 21,
      scale: 1 - 0.2244 * ad * ad,
      x: d * 30,
      y: ad * ad * 7.3,
      z: 10 - Math.abs(slot - mitte)
    };
  }

  function faecherStarten(wurzel) {
    var buehne = wurzel.querySelector('.faecher-buehne');
    var karten = Array.prototype.slice.call(wurzel.querySelectorAll('.faecher-karte'));
    var punkte = Array.prototype.slice.call(wurzel.querySelectorAll('.faecher-punkt'));
    var anzahl = karten.length;
    if (!buehne || !anzahl) return;

    var blaettern = anzahl > SICHTBAR;
    var plaetze = blaettern ? SICHTBAR : anzahl;
    var mitte = blaettern ? HAELFTE : anzahl >> 1;
    var gehoverter = null;

    /** Welche Karte liegt auf welchem Platz? */
    function belegung() {
      var m = {};
      if (!blaettern) {
        karten.forEach(function (_, i) { m[i] = i; });
        return m;
      }
      for (var s = 0; s < SICHTBAR; s++) {
        m[((mitte + s - HAELFTE) % anzahl + anzahl) % anzahl] = s;
      }
      return m;
    }

    function zeichnen() {
      var m = belegung();
      var fb = breitenFaktor(window.innerWidth);
      var fh = hoehenFaktor(window.innerWidth);
      var mittlererSlot = plaetze >> 1;

      var summe = 0;
      for (var q = 0; q < plaetze; q++) { summe += platz(plaetze, q).y; }
      // zusätzlicher Hub, damit die äußeren Karten nicht am Bühnenrand anstoßen
      var ausgleich = summe / plaetze + 1.4;

      karten.forEach(function (karte, i) {
        var slot = m[i];

        if (slot === undefined) {
          karte.style.setProperty('--fop', '0');
          karte.style.setProperty('--fscale', '0.5');
          karte.style.setProperty('--fz', '0');
          karte.setAttribute('aria-hidden', 'true');
          karte.tabIndex = -1;
          return;
        }

        var p = platz(plaetze, slot);
        var x = p.x * fb;
        // Der Bogen wird um seinen eigenen Mittelwert nach oben geschoben,
        // sonst hängt der ganze Fächer am unteren Rand der Bühne.
        var y = (p.y - ausgleich) * fh;
        var rot = p.rot;
        var sc = p.scale;

        // Beim Hover weicht die Nachbarschaft aus, die Karte hebt sich
        if (gehoverter !== null) {
          var dist = Math.abs(slot - gehoverter);
          if (slot === gehoverter) {
            y -= 2.5 * fh;
            sc *= 1.08;
          } else {
            var norm = mittlererSlot > 0 ? (slot - mittlererSlot) / mittlererSlot : 0;
            var schub = 8 * (1 - Math.abs(norm)) * (1 + 0.2 * Math.max(0, 3 - dist));
            if (slot < gehoverter) { x -= schub * fb; rot -= 3 / (dist + 1); }
            else                   { x += schub * fb; rot += 3 / (dist + 1); }
          }
        }

        karte.style.setProperty('--fx', x + 'rem');
        karte.style.setProperty('--fy', y + 'rem');
        karte.style.setProperty('--frot', rot + 'deg');
        karte.style.setProperty('--fscale', sc);
        karte.style.setProperty('--fop', '1');
        karte.style.setProperty('--fz', p.z);
        karte.removeAttribute('aria-hidden');
        karte.tabIndex = 0;
      });

      punkte.forEach(function (pt, i) {
        pt.setAttribute('aria-current', i === mitte ? 'true' : 'false');
      });
    }

    function weiter(richtung) {
      if (!blaettern) return;
      mitte = richtung === 'rechts'
        ? (mitte + 1) % anzahl
        : (mitte - 1 + anzahl) % anzahl;
      gehoverter = null;
      zeichnen();
    }

    wurzel.querySelectorAll('.faecher-pfeil').forEach(function (b) {
      b.addEventListener('click', function () { weiter(b.dataset.richtung); });
    });
    punkte.forEach(function (pt, i) {
      pt.addEventListener('click', function () { mitte = i; gehoverter = null; zeichnen(); });
    });

    karten.forEach(function (karte, i) {
      karte.addEventListener('mouseenter', function () {
        var slot = belegung()[i];
        if (slot === undefined) return;
        gehoverter = slot; zeichnen();
      });
      // Tastaturbedienung: die fokussierte Karte kommt nach vorne
      karte.addEventListener('focus', function () {
        var slot = belegung()[i];
        if (slot === undefined) { mitte = i; }
        gehoverter = null; zeichnen();
      });
    });
    buehne.addEventListener('mouseleave', function () { gehoverter = null; zeichnen(); });

    // Pfeiltasten steuern den Fächer, wenn er den Fokus hat
    wurzel.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') { weiter('links'); e.preventDefault(); }
      if (e.key === 'ArrowRight') { weiter('rechts'); e.preventDefault(); }
    });

    var timer;
    window.addEventListener('resize', function () {
      clearTimeout(timer);
      timer = setTimeout(zeichnen, 120);
    });

    zeichnen();
  }

  /* ── Spotlight ────────────────────────────────────────────────────
     Ein einziger Zeiger-Listener für alle Karten, gedrosselt über
     requestAnimationFrame. Die Vorlage registriert einen Listener pro
     Karte, das ist bei mehreren Karten unnötig teuer.
  ──────────────────────────────────────────────────────────────── */
  function spotlightStarten() {
    var karten = Array.prototype.slice.call(document.querySelectorAll('[data-spot]'));
    if (!karten.length || wenigerBewegung.matches) return;
    if (!window.matchMedia('(hover: hover)').matches) return;

    var letztes = null, geplant = false;

    function anwenden() {
      geplant = false;
      if (!letztes) return;
      karten.forEach(function (k) {
        var r = k.getBoundingClientRect();
        // Nur rechnen, was in Sichtweite liegt
        if (r.bottom < -200 || r.top > window.innerHeight + 200) return;
        k.style.setProperty('--sx', (letztes.x - r.left) + 'px');
        k.style.setProperty('--sy', (letztes.y - r.top) + 'px');
      });
    }

    document.addEventListener('pointermove', function (e) {
      letztes = { x: e.clientX, y: e.clientY };
      if (!geplant) { geplant = true; requestAnimationFrame(anwenden); }
    }, { passive: true });
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-faecher]').forEach(function (el) {
      if (!wenigerBewegung.matches) faecherStarten(el);
    });
    spotlightStarten();
  });
})();
