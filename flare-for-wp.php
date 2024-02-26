<?php

/**
 * FlareForWp
 *
 * @wordpress-plugin
 * Plugin name:         FlareForWp
 * Description:         This is my plugin flareforwp
 * Version:             0.1.0
 * Requires at least:   6.0
 * Requires PHP:        8.0
 * Author:              Jeffrey van Rossum
 * Author URI:          https://vanrossum.dev
 * Text Domain:         flareforwp
 * Domain Path:         /languages
 * License:             MIT
 */

use Jeffreyvr\FlareForWp\FlareForWp;

define('FLAREFORWP_PLUGIN_VERSION', '0.1.0');
define('FLAREFORWP_PLUGIN_FILE', __FILE__);
define('FLAREFORWP_PLUGIN_DIR', __DIR__);

if (! class_exists(FlareForWp::class)) {
    if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
        require_once __DIR__.'/vendor/autoload_packages.php';
    }
}

function flareForWp()
{
    return FlareForWp::instance();
}

flareForWp();
