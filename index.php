<?php

/**
 * Kirby HTML Pretty-Print Plugin
 * 
 * Formatiert HTML schön und minifiziert JavaScript/CSS
 * 
 * @package   Kirby HTML Pretty
 * @author    Felix Schwenzel
 * @link      https://wirres.net
 * @version   1.0.4
 */

// Composer Autoloader für Plugin-Dependencies laden
@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('diplix/html-pretty', [
    'info' => [
        'name' => 'HTML Pretty',
        'description' => 'Formats Kirby HTML output and minifies JavaScript and CSS.',
        'version' => '1.0.4',
        'author' => 'Felix Schwenzel',
        'link' => 'https://github.com/diplix/kirby-html-pretty',
        'license' => 'MIT'
    ],
    'options' => [
        'minifyJs' => true,
        'minifyCss' => true,
        'removeComments' => true,
        'indentCharacters' => '    '  // 4 Leerzeichen
    ],
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

