<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle;

use Mautic\IntegrationsBundle\Bundle\AbstractPluginBundle;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\DependencyInjection\Compiler\TwigFormThemePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
class LeuchtfeuerCustomNavlinksBundle extends AbstractPluginBundle
{
   public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new TwigFormThemePass());
    }

    public function getJs()
    {
        return [
            'plugins/YourPluginBundle/Assets/js/custom.js',
        ];
    }
}
