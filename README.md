# Kirby HTML Pretty-Print Plugin

Formatiert HTML schön und minifiziert JavaScript/CSS für Kirby CMS.

## Features

- ✨ Schöne HTML-Formatierung mit Einrückungen
- 📦 JavaScript-Minifizierung (Einsparungen bis zu 3,5 KB)
- 🎨 CSS-Minifizierung
- 💬 Entfernung von HTML-Kommentaren
- 🚀 Funktioniert für alle Caching-Mechanismen
- 🔧 Nur im Production-Modus aktiv (nicht bei `debug=true`)

## Installation

1. Kopiere das Plugin-Verzeichnis nach `site/plugins/kirby-html-pretty/`
2. Installiere die Dependencies:
   ```bash
   cd site/plugins/kirby-html-pretty
   composer install
   ```

Das Plugin ist selbstständig und enthält alle benötigten Dependencies.

## Konfiguration

Das Plugin ist sofort aktiv und benötigt keine Konfiguration. Es greift automatisch über den `page.render:after` Hook ein, bevor das HTML gecacht wird.

## Deaktivierung

Um das Plugin zu deaktivieren, entferne einfach das Plugin-Verzeichnis oder setze `debug => true` in der `config.php`.

## Technische Details

- Verwendet `wa72/html-pretty-min` für die Formatierung
- Hook: `page.render:after` (greift nach allen anderen Plugins)
- Nur aktiv wenn `option('debug') !== true`

