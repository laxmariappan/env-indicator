<?php

namespace Lax\EnvIndicator\Tests\Unit;

use Lax\EnvIndicator\EnvService;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;
use Mockery;

final class EnvServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected $service;

    public function setUp(): void
    {
        parent::setUp();
        \Brain\Monkey\setUp();
        $this->service = Mockery::mock(EnvService::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }

    public function tearDown(): void
    {
        \Brain\Monkey\tearDown();
        parent::tearDown();
    }

    public function test_capabilities()
    {


        Functions\when('current_user_can')->alias(
            function ($cap) {
                return 'manage_options' === $cap;
            }
        );

        $this->assertTrue(current_user_can('manage_options'));
        // phpcs:ignore WordPress.WP.Capabilities.Unknown
        $this->assertFalse(current_user_can('foobar'));
        // phpcs:ignore WordPress.WP.Capabilities.RoleFound
        $this->assertFalse(current_user_can('administrator'));


        Functions\when('is_admin_bar_showing')->alias(
            function ($adminBar) {
                return true === $adminBar;
            }
        );

        $this->assertTrue(is_admin_bar_showing(true), 'is_admin_bar_showing');
    }
}
