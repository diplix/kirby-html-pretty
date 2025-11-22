<?php

/**
 * Formatiert HTML schön (Pretty-Print)
 * 
 * Verwendet wa72/html-pretty-min für saubere Formatierung mit Einrückungen
 * 
 * @param string $html Das zu formatierende HTML
 * @return string Formatiertes HTML
 */
function prettyHtml(string $html): string
{
    // Leere oder sehr kurze Strings direkt zurückgeben
    if (trim($html) === '' || strlen($html) < 10) {
        return $html;
    }

    // Prüfen ob es HTML ist (mindestens ein Tag enthalten)
    if (!preg_match('/<[^>]+>/', $html)) {
        return $html;
    }

    try {
        // HTML5-DOCTYPE hinzufügen, falls nicht vorhanden (für bessere DOMDocument-Kompatibilität)
        $hasDoctype = preg_match('/<!doctype\s+html>/i', $html);
        $htmlToFormat = $html;
        if (!$hasDoctype && preg_match('/<html/i', $html)) {
            // HTML5-DOCTYPE vor <html> einfügen
            $htmlToFormat = preg_replace('/<html/i', '<!DOCTYPE html>' . "\n" . '<html', $html, 1);
        }
        
        // Library verwenden für Pretty-Print
        $minifyJs = true;   // JavaScript minifizieren
        $minifyCss = true;  // CSS minifizieren
        $removeComments = true; // Kommentare entfernen
        
        $formatter = new \Wa72\HtmlPrettymin\PrettyMin([
            'minify_js' => $minifyJs,
            'minify_css' => $minifyCss,
            'remove_comments' => $removeComments,
            'keep_whitespace_around' => [ 
                // keep whitespace around inline elements 
                'b', 'big', 'i', 'small', 'tt', 
                'abbr', 'acronym', 'cite', 'code', 'dfn', 'em', 'kbd', 'strong', 'samp', 'var', 
                'a', 'bdo', 'br', 'img', 'map', 'object', 'q', 'span', 'sub', 'sup', 
                'button', 'input', 'label', 'select', 'textarea', 's', 'ruby', 'rt', 'rp',
                'time', 'del', 'ins', 'mark', 'u', 'data', 'bdi'
            ],
            'indent_characters' => "    "   // 4 Leerzeichen für Einrückung
        ]);
        
        // HTML laden, formatieren und zurückgeben
        // Fehler unterdrücken für HTML5-Tags (DOMDocument hat Probleme mit HTML5)
        $libxmlPreviousState = libxml_use_internal_errors(true);
        
        // Minifizierung vor dem Indentieren (wenn aktiviert)
        $formatter->load($htmlToFormat);
        if ($minifyJs || $minifyCss || $removeComments) {
            $formatter->minify();
        }
        $formatted = $formatter->indent()
                               ->saveHtml();
        
        libxml_use_internal_errors($libxmlPreviousState);
        
        // Wenn Formatierung fehlgeschlagen ist (z.B. wegen HTML5-Tags), Original zurückgeben
        if (empty($formatted) || strlen($formatted) < 10) {
            return $html;
        }
        
        // DOCTYPE wieder entfernen, falls wir es hinzugefügt haben
        if (!$hasDoctype) {
            $formatted = preg_replace('/<!DOCTYPE\s+html>\s*/i', '', $formatted, 1);
        }
        
        // Leerzeilen am Anfang/Ende entfernen
        return trim($formatted);
        
    } catch (\Exception $e) {
        // Bei Fehlern Original zurückgeben
        return $html;
    }
}

