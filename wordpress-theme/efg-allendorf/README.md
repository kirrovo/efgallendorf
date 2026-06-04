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
> - alle Seiten (Wer wir sind, Gottesdienst Live, Kalender, Intern, Kontakt, Impressum, Datenschutz)
> - die Startseite (als statische Front-Page)
> - das Hauptmenü „Hauptnavigation"
>
> Falls die Unterseiten 404 zeigen: einmal **Einstellungen → Permalinks → Speichern**
> klicken (schreibt die URL-Regeln neu).

---

## Inhalte pflegen

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

Version 1.0.0 · benötigt WordPress ≥ 6.0 und PHP ≥ 7.4
