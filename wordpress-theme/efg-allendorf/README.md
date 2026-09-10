# EFG Allendorf – WordPress-Theme

Klassisches WordPress-Theme der Evangelischen Freien Gemeinde Allendorf.
1:1-Umsetzung der statischen Website mit **Custom Post Types** für Gruppen
und Veranstaltungen sowie **Webcrawler-Schutz** für alle Kontaktdaten.

---

## Installation

### Variante A – über das WordPress-Backend (empfohlen)
1. Den Ordner `efg-allendorf` als **ZIP-Datei** packen.
2. Im WP-Admin: **Design → Themes → Theme hinzufügen → Theme hochladen**.
3. ZIP auswählen, **Installieren** und **Aktivieren**.

### Variante B – per FTP / Datei-Manager
1. Den kompletten Ordner `efg-allendorf` nach
   `wp-content/themes/` hochladen.
2. Im WP-Admin unter **Design → Themes** aktivieren.

> **Beim Aktivieren** legt das Theme automatisch an:
> - 8 Gruppen (CPT „Gruppen")
> - 3 Veranstaltungen (CPT „Veranstaltungen")
> - alle Seiten (Wer wir sind, Gottesdienst Live, Kalender, Kontakt, Impressum, Datenschutz)
> - die Startseite (als statische Front-Page)
> - das Hauptmenü „Hauptnavigation"
>
> Falls die Unterseiten 404 zeigen: einmal **Einstellungen → Permalinks → Speichern**
> klicken (schreibt die URL-Regeln neu).

---

## Inhalte pflegen

### Kontakt-Buttons (1.0.2)

„Kontakt aufnehmen“ öffnet die hinterlegte E-Mail-Adresse der jeweiligen
Gruppenleitung per `mailto:`. Fehlt eine E-Mail, wird die hinterlegte
Telefonnummer per `tel:` geöffnet. Das Gerät verwendet die dafür
eingerichtete Mail- beziehungsweise Telefon-App.

### Update auf 1.0.1

Der Mitglieder-Login und seine Verweise wurden entfernt. Die Datei
`template-intern.php` bleibt nur als 404-Schutz für bestehende
Seitenzuweisungen erhalten und gibt keine gespeicherten Inhalte aus.
Bereits vorhandene Menüeinträge zu dieser Seite werden ausgeblendet.
Die alte Seite im WordPress-Backend unter **Seiten** in den Papierkorb
verschieben. Der WordPress-Admin-Zugang zur Inhaltspflege bleibt erhalten.

| Bereich | Wo im Admin |
|---|---|
| Gruppen & Kreise | **Gruppen** (linkes Menü) |
| Veranstaltungen (Startseite) | **Veranstaltungen** |
| Texte der Unterseiten | **Seiten** |
| Navigation | **Design → Menüs** |
| Logo | **Design → Customizer → Website-Informationen → Logo** |

### Gruppen-Felder
Jede Gruppe hat Felder für Emoji, Zielgruppe (Badge), Farbverlauf,
Treffzeit, Ort, Ansprechperson (Name, Initialen, Telefon, E-Mail) usw.
Telefon und E-Mail werden auf der Website automatisch **vor Webcrawlern
geschützt** (base64 + JavaScript) – sie erscheinen nicht im Quelltext.

---

## Kontaktdaten-Schutz im Code verwenden

In Templates stehen Helfer-Funktionen bereit:

```php
efga_email_text( 'info@eg-allendorf.de' );   // geschützter Text
efga_email( 'info@eg-allendorf.de', $icon );  // geschützter Link (mit Icon)
efga_phone_text( '06478 / 277 200' );          // geschützter Text
efga_phone_link( '06478 / 277 200' );          // geschützter Link
```

Dekodiert wird erst im Browser über `assets/js/contacts.js`.

---

## Kontaktformular (echter Versand)

Das Formular auf Kontakt/Startseite ist ein Platzhalter ohne Versand.
Für echten E-Mail-Versand ein Plugin wie **Contact Form 7** oder
**Fluent Forms** installieren und in `template-parts/kontakt.php`
den `<form>`-Block durch den Plugin-Shortcode ersetzen.

---

## Google-Kalender einbinden

In `template-parts/kalender.php` den statischen Kalender durch ein
Google-Kalender-`<iframe>` ersetzen (Google Kalender → Einstellungen →
Einbetten). Datenschutzhinweis in der Datenschutzerklärung ist bereits
enthalten.

---

## Dateien

```
efg-allendorf/
├── style.css                  Theme-Header + komplettes CSS
├── functions.php              Setup, Assets, CPTs, Meta-Felder, Kontakt-Helfer
├── header.php / footer.php    Navigation & Footer
├── front-page.php             Startseite
├── archive-gruppe.php         Gruppen-Übersicht
├── single-gruppe.php          Gruppen-Detailseite
├── single-veranstaltung.php   Veranstaltungs-Detailseite
├── template-*.php             Seiten-Templates (Wer wir sind, Live, Kontakt …)
├── page.php / index.php / 404.php
├── inc/seed-content.php       Beispiel-Inhalte bei Aktivierung
├── template-parts/            Wiederverwendbare Bausteine
└── assets/
    ├── js/contacts.js         Webcrawler-Schutz
    └── img/                   Logo & Gemeindefoto
```

---

Version 1.0.4 · benötigt WordPress ≥ 6.0 und PHP ≥ 7.4


## Automatische YouTube-Predigten (1.0.4)

Die Startseite lädt die drei neuesten veröffentlichten Videos des Kanals
`UCuJKSbQamH2tmewkiZJICmA` über den öffentlichen JSON-Endpunkt
`https://efgallendorf.vercel.app/api/predigten`. Dieser Dienst gehört zum
Website-Repository und muss für die automatische Aktualisierung erreichbar bleiben.
Er liest den YouTube-Feed und prüft die Video-Metadaten. Falls YouTube einzelne
Videoabfragen vom Hosting aus einschränkt, prüft er die Laufzeit-Anzeigen in den
öffentlichen Kanalübersichten. Angekündigte und noch laufende Livestreams werden
ausgeschlossen; unbekannte Zustände führen zum gekennzeichneten Rückfall. Cache: fünf Minuten;
offene sichtbare Seiten aktualisieren sich ebenfalls alle fünf Minuten.

Bei einem Ausfall bleiben die zuletzt geladenen beziehungsweise mitgelieferten,
verifizierten Videos sichtbar; der Hinweis nennt den Stand und verlinkt den Kanal.
Das Theme enthält keine Zugangsdaten. YouTube wird erst beim Klick geöffnet.


## Gruppen-Slider (1.0.7)

Der Kartenfächer zeigt eine große aktive Karte und bis zu zwei Bildvorschauen je
Seite. Vorschauen zuerst auswählen, die aktive Karte öffnet das Gruppenangebot.
Pfeile, horizontales Wischen/Ziehen und Tastatur (Pfeile, Pos1, Ende) wechseln
umlaufend durch die vorhandenen Bilder. Der Zähler ersetzt die kleinen Punkte.
Keine automatische Wiedergabe; reduzierte Bewegung bleibt bedienbar. Ohne
JavaScript stehen alle vorhandenen Bilder als horizontal scrollbare Reihe bereit.


## Früheres Livestream-Standbild (1.0.8)

Original-Videostandbild aus dem EFG-Gottesdienst vom 06.09.2026:
https://www.youtube.com/watch?v=dQ_TlADxXw0
Bildquelle: https://i.ytimg.com/vi/dQ_TlADxXw0/maxres3.jpg (1280×720).
Das damals verwendete Standbild wurde durch das Bibelmotiv ersetzt und bei der
Bereinigung am 10.09.2026 aus dem Theme entfernt.
Die Abdunklung für lesbare Bedienelemente erfolgt ausschließlich per CSS;
YouTube wird weiterhin erst beim Klick aufgerufen.


## Livestream-Symbolbild (1.0.25)

Seit 10.09.2026 zeigt die Vorschau eine KI-generierte offene Bibel im Morgenlicht.
Das Motiv ist ein Symbolbild und keine Aufnahme der EFG-Räumlichkeiten.
Erstellt mit dem integrierten OpenAI-imagegen-Tool, native Größe 1672 × 941 Pixel,
keine Hochskalierung. WebP mit Qualität 85, unveränderte Bildabmessungen.
Statische Website: `bilder/livestream-bibel.webp`; Theme: `assets/img/livestream-bibel.webp`.
Das frühere YouTube-Standbild wurde bei der Bereinigung am 10.09.2026 entfernt. Play-Button, Text und
YouTube-Link bleiben HTML; ein leichter CSS-Verlauf sichert die Lesbarkeit.

Verwendeter Prompt:

> Create one premium photorealistic landscape photograph for a German Christian congregation website's livestream preview, aspect ratio 16:9. A beautiful well-used open Bible rests on a simple natural oak wooden table, primarily in the lower right third of the composition. Warm soft morning daylight enters from the upper left, natural gentle shadows, quiet inviting atmosphere, realistic paper and wood textures. A restrained softly blurred interior background in muted warm neutrals with subtle slate blue shadows, not a recognizable actual church. The center and left two thirds should be calm unobstructed negative space of medium-dark tonal value so a white headline and a red play button can be overlaid later by the website. The book should be recognizable as a Bible but its small printed words are naturally indistinct from the camera angle and shallow depth of field. Editorial photography, understated and authentic, no dramatic fantasy rays, no artificial glowing objects. No people, no added typography, no logos, no watermark, no UI or play icon. Wide cinematic framing with ample breathing room, welcoming rather than gloomy.


## Aktualisiertes Gemeindefoto (1.0.29)

Auf Nutzerwunsch am 10.09.2026 durch die angehängte Datei
`Codex-Bild 10. Sept. 2026, 15_02_34.png` ersetzt.
Unverändertes Motiv und native Abmessungen 1672 × 941 Pixel, nur als WebP
(Qualität 90) komprimiert. Startseite und Wer wir sind verwenden
`bilder/gemeinde-aktuell.webp`, im Theme `assets/img/gemeinde-aktuell.webp`.
Die Startseite im Theme bevorzugt weiterhin ein individuell gepflegtes Beitragsbild.


## Bereinigung (1.0.30)

Nicht mehr eingebundene ältere Gemeinde- und Livestream-Bilder aus Website und
Theme entfernt. Aktuell verwendet: `gemeinde-aktuell.webp`, `livestream-bibel.webp`
sowie die Gruppenbilder, Logos und Favicons.
Die Kundenbriefings liegen im Kundenordner unter `../Briefings/`, das ursprüngliche
Gemeindefoto und die unbenutzte Gemeindehausaufnahme unter `../Bildbearbeitung/`
(jeweils relativ zum Website-Ordner).
Die veraltete lokale Ruby-/Claude-Startkonfiguration wurde entfernt.
Theme-Templates, Quellcode, YouTube-Tests, Deployment-Konfiguration und dieses
installierbare Theme-Paket bleiben Bestandteil des Projekts.


## Geschwindigkeit, SEO und Besucherantworten (1.0.31)

- Gruppenbilder in WebP mit 480/960/1400-Pixel-Varianten; Gemeinde- und
  Livestreammotiv mit 640/1024/1672-Pixel-Varianten. Native Beitragsbilder
  können weiterhin im WordPress-Backend gepflegt werden.
- Gebündelte minimierte CSS-/JS-Dateien, Bildabmessungen und priorisierte
  Hero-Bilder. Menü und Footer werden in WordPress weiterhin serverseitig gerendert.
- Metabeschreibungen, Social-Metadaten, Gemeinde-/Website-/Seiten- und
  Breadcrumb-Strukturdaten über inc/seo.php. Canonical-URLs nutzen die tatsächliche
  WordPress-Adresse. Bei Yoast, Rank Math oder AIOSEO überlässt das Theme die
  SEO-Metadaten dem Plugin, um Duplikate zu vermeiden.
- Fünf sichtbare Besucherfragen auf der Startseite, mit übereinstimmendem
  FAQ-Markup. Das ist keine Garantie für Rich Results oder KI-Zitate.
- Die WordPress-Core-Sitemap bleibt unter /wp-sitemap.xml zuständig.
- Stammdaten/Fragen werden aus inc/site.json gelesen; die zentrale Quelle
  für das gesamte Projekt ist data/site.json im Website-Ordner. Nach Änderungen
  dort npm run build ausführen und das Theme-ZIP neu packen.
