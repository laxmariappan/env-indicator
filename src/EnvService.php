<?php

declare(strict_types=1);

namespace Lax\EnvIndicator;

use WP_Admin_Bar;

class EnvService
{
    public function __construct()
    {
        \add_action('init', [$this, 'menu']);
    }

    public function menu(): void
    {
        if (!\current_user_can('manage_options') || !\is_admin_bar_showing()) {
            return;
        }

        /**
         * @see \WP_Admin_Bar::add_node
         * Lower the number, higher the priority on the menu. 20 is set to make it second menu item.
         * 10 is the default.
         */
        \add_action('admin_bar_menu', [$this, 'createMenu'], 20, 1);
    }

    public function createMenu(WP_Admin_Bar $adminBar): void
    {   
        $env = defined('WP_ENVIRONMENT_TYPE') ? \WP_ENVIRONMENT_TYPE : '';

        if (!$env) {
            return;
        }

        $adminBar->add_node([
            'group' => false,
            'href' => '#',
            'id' => 'env-indicator',
            'meta' => [
                'class' => 'env-indicator',
            ],
            'parent' => '',
            'title' => 'env: ' . $env,
        ]);
    }
}
