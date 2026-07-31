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
    var sperrTimer;
    var vorherSichtbar = {};
    var ersterAuftritt = true;
    var laeuft = false;   // sperrt Hover und Neuzeichnen während Auftritt/Blättern

    /** Werte setzen, ohne dass die laufende Transition sie weichzeichnet. */
    function sofort(karte, werte) {
      karte.style.transition = 'none';
      setzen(karte, werte);
      void karte.offsetWidth;          // Layout erzwingen
      karte.style.transition = '';
    }

    function setzen(karte, w) {
      if (w.x !== undefined)     karte.style.setProperty('--fx', w.x + 'rem');
      if (w.y !== undefined)     karte.style.setProperty('--fy', w.y + 'rem');
      if (w.rot !== undefined)   karte.style.setProperty('--frot', w.rot + 'deg');
      if (w.scale !== undefined) karte.style.setProperty('--fscale', w.scale);
      if (w.op !== undefined)    karte.style.setProperty('--fop', w.op);
      if (w.z !== undefined)     karte.style.setProperty('--fz', w.z);
    }

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

    function zeichnen(richtung) {
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

        var warSichtbar = vorherSichtbar[i];

        if (slot === undefined) {
          // Gerichteter Abgang: die Karte fliegt zur Gegenseite hinaus
          if (warSichtbar && richtung) {
            setzen(karte, {
              x: richtung === 'rechts' ? -40 : 40,
              rot: richtung === 'rechts' ? -30 : 30,
              scale: 0.5, op: 0, z: 0
            });
          } else {
            setzen(karte, { scale: 0.5, op: 0, z: 0 });
          }
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

        var ziel = { x: x, y: y, rot: rot, scale: sc, op: 1, z: p.z };

        if (ersterAuftritt) {
          // Auftritt: von unten, klein und unsichtbar, gestaffelt pro Platz
          sofort(karte, { x: 0, y: 12 * fh, rot: 0, scale: 0.5, op: 0, z: p.z });
          karte.classList.add('faecher-auftritt');
          karte.style.transitionDelay = (0.2 + slot * 0.06) + 's';
          requestAnimationFrame(function () {
            requestAnimationFrame(function () { setzen(karte, ziel); });
          });
        } else if (!warSichtbar && richtung) {
          // Eintritt von der Seite, aus der geblättert wurde
          sofort(karte, {
            x: richtung === 'rechts' ? 40 : -40,
            y: y,
            rot: richtung === 'rechts' ? 30 : -30,
            scale: 0.5, op: 0, z: p.z
          });
          karte.classList.add('faecher-auftritt');
          karte.style.transitionDelay = '0s';
          requestAnimationFrame(function () { setzen(karte, ziel); });
        } else {
          karte.classList.remove('faecher-auftritt');
          karte.style.transitionDelay = '0s';
          setzen(karte, ziel);
        }

        karte.removeAttribute('aria-hidden');
        karte.tabIndex = 0;
      });

      vorherSichtbar = {};
      Object.keys(m).forEach(function (i) { vorherSichtbar[i] = true; });

      // Während Auftritt und Blättern ruht die Interaktion, sonst
      // überschreibt ein Hover die gestaffelte Bewegung.
      if (ersterAuftritt || richtung) {
        laeuft = true;
        clearTimeout(sperrTimer);
        sperrTimer = setTimeout(function () { laeuft = false; },
          ersterAuftritt ? 1600 : 700);
      }
      ersterAuftritt = false;

      punkte.forEach(function (pt, i) {
        pt.setAttribute('aria-current', i === mitte ? 'true' : 'false');
      });
    }

    function weiter(richtung) {
      if (!blaettern || laeuft) return;
      mitte = richtung === 'rechts'
        ? (mitte + 1) % anzahl
        : (mitte - 1 + anzahl) % anzahl;
      gehoverter = null;
      zeichnen(richtung);
    }

    wurzel.querySelectorAll('.faecher-pfeil').forEach(function (b) {
      b.addEventListener('click', function () { weiter(b.dataset.richtung); });
    });
    punkte.forEach(function (pt, i) {
      pt.addEventListener('click', function () { mitte = i; gehoverter = null; zeichnen(); });
    });

    karten.forEach(function (karte, i) {
      karte.addEventListener('mouseenter', function () {
        if (laeuft) return;
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
    buehne.addEventListener('mouseleave', function () {
      if (laeuft) return;
      gehoverter = null; zeichnen();
    });

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

  /* ── Gleitender Text in der Navigation ────────────────────────────
     Die Vorlage hinterlegt jeden Link doppelt. Statt das im Markup zu
     verdoppeln, baut das Skript die zweite Kopie zur Laufzeit ein.
     Läuft für beide Varianten: statisches HTML und wp_nav_menu.
  ──────────────────────────────────────────────────────────────── */
  function navGleitenStarten() {
    if (wenigerBewegung.matches) return;
    var links = document.querySelectorAll('#hauptnavigation a');
    Array.prototype.forEach.call(links, function (a) {
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

  /* ── Konturschriftzug im Footer ───────────────────────────────────
     Die farbige Kontur wird durch eine radiale Maske sichtbar, deren
     Mittelpunkt dem Zeiger folgt. Die Vorlage nutzt dafür motion und
     einen Regenbogen; hier reicht das Setzen zweier SVG-Attribute,
     und die Farben bleiben im Blau der Seite.
  ──────────────────────────────────────────────────────────────── */
  function schriftzugStarten() {
    var wurzel = document.querySelector('[data-schriftzug]');
    if (!wurzel || wenigerBewegung.matches) return;
    if (!window.matchMedia('(hover: hover)').matches) return;

    var svg = wurzel.querySelector('svg');
    var verlauf = wurzel.querySelector('#ft-maske-verlauf');
    var spur = wurzel.querySelector('.ft-spur');
    if (!svg || !verlauf || !spur) return;

    var geplant = false, letztes = null;
    spur.style.opacity = '0';
    spur.style.transition = 'opacity .3s ease';

    function anwenden() {
      geplant = false;
      if (!letztes) return;
      var r = svg.getBoundingClientRect();
      // Bildschirmkoordinaten in das viewBox-System 300x100 umrechnen
      verlauf.setAttribute('cx', ((letztes.x - r.left) / r.width) * 300);
      verlauf.setAttribute('cy', ((letztes.y - r.top) / r.height) * 100);
    }

    svg.addEventListener('pointermove', function (e) {
      letztes = { x: e.clientX, y: e.clientY };
      spur.style.opacity = '1';
      if (!geplant) { geplant = true; requestAnimationFrame(anwenden); }
    }, { passive: true });

    svg.addEventListener('pointerleave', function () { spur.style.opacity = '0'; });
  }

  // Der statische Footer wird per JS gerendert, daher nachziehbar halten
  window.efgaSchriftzug = schriftzugStarten;

  document.addEventListener('DOMContentLoaded', function () {
    navGleitenStarten();
    setTimeout(navGleitenStarten, 0);
    schriftzugStarten();
    setTimeout(schriftzugStarten, 0);
    document.querySelectorAll('[data-faecher]').forEach(function (el) {
      if (!wenigerBewegung.matches) faecherStarten(el);
    });
    spotlightStarten();
  });
})();
