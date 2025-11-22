<?php

/**
 * Kirby HTML Pretty-Print Plugin
 * 
 * Formatiert HTML schön und minifiziert JavaScript/CSS
 * 
 * @package   Kirby HTML Pretty
 * @author    Felix Schwenzel
 * @link      https://wirres.net
 * @version   1.0.0
 */

// Composer Autoloader für Plugin-Dependencies laden
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Helper-Funktion laden
require_once __DIR__ . '/src/helpers.php';

Kirby::plugin('diplix/html-pretty', [
    'hooks' => [
        'page.render:after' => function ($contentType, $data, $page, $html) {
            // HTML Pretty-Print vor dem Caching (wird vom Static-Cache-Plugin verwendet)
            // Nur im Production-Modus aktiv (nicht bei debug=true)
            if ($contentType === 'html' && 
                option('debug') !== true && 
                function_exists('prettyHtml') &&
                !empty($html)) {
                return prettyHtml($html);
            }
            return $html;
        }
    ]
]);

