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

Copy the plugin directory to `site/plugins/kirby-html-pretty/`

Alternatively, you can install it with composer: `composer require diplix/html-pretty`

## Configuration

You can configure the plugin options in your `config.php`:

```php
return [
    'diplix.html-pretty.minifyJs' => true,        // Minify JavaScript (default: true)
    'diplix.html-pretty.minifyCss' => true,       // Minify CSS (default: true)
    'diplix.html-pretty.removeComments' => true,  // Remove HTML comments (default: true)
    'diplix.html-pretty.indentCharacters' => '    ', // Indentation characters (default: 4 spaces)
];
```

### Available Options

- **`diplix.html-pretty.minifyJs`** (boolean, default: `true`)  
  Minifies inline JavaScript code.

- **`diplix.html-pretty.minifyCss`** (boolean, default: `true`)  
  Minifies inline CSS code.

- **`diplix.html-pretty.removeComments`** (boolean, default: `true`)  
  Removes HTML comments from the output.

- **`diplix.html-pretty.indentCharacters`** (string, default: `'    '`)  
  Characters used for indentation (default: 4 spaces).

The plugin uses the `page.render:after` hook.

## Additional Info

* Uses `wa72/html-pretty-min` for formatting
* Hook: `page.render:after` (runs after all other plugins)
* Only active when `option('debug') !== true`
