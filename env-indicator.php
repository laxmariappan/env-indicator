<?php

/*
 * @wordpress-plugin
 * Plugin Name: Environment Indicator.
 * Description: Shows the current environment on WP admin bar.
 * Version: 1.0.0
 * License: GPLv2+
 * Requires at least: 6.3
 * Requires PHP: 8.0
 * Update URI: false
 */

declare(strict_types=1);

namespace Lax\EnvIndicator;

use Inpsyde\Modularity;

is_readable(__DIR__ . '/vendor/autoload.php') && require_once __DIR__ . '/vendor/autoload.php';

function plugin(): Modularity\Package
{
    static $package;
    if (!$package) {
        $properties = Modularity\Properties\PluginProperties::new(__FILE__);
        $package = Modularity\Package::new($properties)
            ->addModule(new EnvModule());
    }

    return $package;
}

add_action(
    'plugins_loaded',
    static function (): void {
        plugin()->boot();
    }
);