<?php

declare(strict_types=1);

namespace Lax\EnvIndicator;

use Inpsyde\Modularity\Module\ExecutableModule;
use Inpsyde\Modularity\Module\ServiceModule;
use Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use Psr\Container\ContainerInterface;
use Inpsyde\WpContext;
use Lax\EnvIndicator\EnvService;

class EnvModule implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;

    public function services(): array
    {
        return [
            // phpcs:disable Inpsyde.CodeQuality.LineLength.TooLong,Inpsyde.CodeQuality.VariablesName.SnakeCaseVar
            'EnvService' => static function (ContainerInterface $_containerInterface): EnvService {
                return new EnvService();
            },
        ];
    }

    public function run(ContainerInterface $container): bool
    {
        $context = WpContext::determine();
        if (!$context->is(WpContext::FRONTOFFICE, WpContext::BACKOFFICE)) {
            return false;
        }

        return true;
    }
}
