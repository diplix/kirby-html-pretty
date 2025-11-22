# Kirby HTML Pretty-Print Plugin

Formats Kirby HTML output and minifies JavaScript and CSS.
I vibe coded this with cursor, but tested it extensively on <https://wirres.net>.

## Features

* HTML formatting with indentation
* JavaScript minification
* CSS minification
* Removal of HTML comments
* Compatible with most Kirby caching mechanisms
* Disabled in debug mode

## Installation

1. Copy the plugin directory to `site/plugins/kirby-html-pretty/`

## Configuration

There is currently no `config.php` configuration yet (TODO).
All options are located in `src/helpers.php`.

The plugin uses the `page.render:after` hook.

## Technical Details

* Uses `wa72/html-pretty-min` for formatting
* Hook: `page.render:after` (runs after all other plugins)
* Only active when `option('debug') !== true`
