# Website-Pflege nach der Optimierung

## Änderungen bearbeiten

- Inhalte weiterhin in den jeweiligen HTML-Seiten pflegen.
- Navigation und Footer zentral in `nav.js` ändern; CSS in `style.css`.
- Domain, Beschreibungen und Besucherfragen zentral in `data/site.json` ändern.
- Danach `npm ci`, `npm run build` und `npm run check` ausführen. Vercel baut beim Deployment ebenfalls automatisch.
- `assets/` enthält minimierte Dateien mit Inhalts-Hash. Sie werden beim Build aktualisiert; diese Dateien nicht von Hand bearbeiten.
- Der Build schreibt Navigation, Footer, Kontakte und Metadaten direkt ins HTML. JavaScript ergänzt Menübedienung, Bildslider und aktuelle Predigten.
- Für Bildvarianten gelten 480/960/1400 px bei Gruppenbildern und 640/1024/1672 px beim Gemeinde-/Livestreambild. Nur existierende Varianten in srcset eintragen. Ausgangsbilder liegen im Kundenordner `Bildbearbeitung/Website-Originalbilder`.
- WordPress-Dateien separat pflegen; `npm run build` aktualisiert dort minimierte Ressourcen und `inc/site.json`. Anschließend das Theme-ZIP erneuern.

## Suchmaschinen und KI-Antworten

Die 20 öffentlichen Seiten besitzen individuelle Beschreibungen, Canonical-URLs,
Social-Metadaten sowie strukturierte Gemeinde-, Website-, Seiten- und Breadcrumb-Daten.
Die Startseite enthält fünf sichtbare Besucherfragen mit passendem FAQ-Markup.
Sitemap: `/sitemap.xml`. Crawler-Regeln: `/robots.txt`.

Aktuelle kanonische Domain: `https://efgallendorf.vercel.app`.
Bei Umstellung auf eine eigene Domain zuerst `data/site.json` anpassen, neu bauen
und Weiterleitungen sowie Sitemap prüfen. WordPress verwendet seine eigene konfigurierte Domain.

Indexierung, Suchpositionen, Google-Rich-Results und Erwähnungen in KI-Antworten
werden nicht durch Markup garantiert. Es wurden keine erfundenen Bewertungen,
Veranstaltungsdaten, Öffnungszeiten oder Koordinaten hinzugefügt. Kein externer
Tracking-Dienst wurde installiert. Search Console/Bing Webmaster Tools benötigen
Zugriff auf die passende verifizierte Domain und wurden hier nicht eingerichtet.

Grundlagen: [Google zu KI-Suchfunktionen](https://developers.google.com/search/docs/appearance/ai-features),
[Canonical-URLs](https://developers.google.com/search/docs/crawling-indexing/consolidate-duplicate-urls),
[Web-Performance und LCP](https://web.dev/articles/optimize-lcp),
[Vercel-Caching](https://vercel.com/docs/caching/cache-control-headers).
