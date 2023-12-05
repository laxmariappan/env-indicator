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

        \add_action('admin_bar_menu', [$this, 'createMenu'], 20, 1);
    }

    public function createMenu(WP_Admin_Bar $adminBar): void
    {
        $adminBar->add_node([
            'id' => 'env-indicator',
            'title' => 'env: ' . \WP_ENVIRONMENT_TYPE,
            'href' => false,
        ]);
    }
}
