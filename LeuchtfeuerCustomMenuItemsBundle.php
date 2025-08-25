<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle;

use Mautic\IntegrationsBundle\Bundle\AbstractPluginBundle;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\DependencyInjection\Compiler\TwigFormThemePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
class LeuchtfeuerCustomMenuItemsBundle extends AbstractPluginBundle
{
   public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new TwigFormThemePass());
    }


}
