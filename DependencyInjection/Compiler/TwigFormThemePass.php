<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwigFormThemePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasParameter('twig.form.resources')) {
            return;
        }

        $formThemes = $container->getParameter('twig.form.resources');

        if (!is_array($formThemes)) {
            throw new \LogicException('Container parameter "twig.form.resources" must be an array.');
        }

        $formThemes[] = '@LeuchtfeuerCustomMenuItems/FormTheme/Custom.html.twig';

        $container->setParameter('twig.form.resources', $formThemes);
    }
}
