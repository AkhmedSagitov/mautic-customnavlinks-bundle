<?php

declare(strict_types=1);

use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\EventSubscriber\MenuEventSubscriber;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\Config;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\CustomNavlinksIntegration;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\Support\ConfigSupport;


return [
    'name'        => 'Custom Navlinks by Leuchtfeuer',
    'description' => 'Custom Navlinks by Leuchtfeuer',
    'version'     => '1.0.0',
    'author'      => 'Leuchtfeuer Digital Marketing GmbH',
    'services'    => [
        'integrations' => [
            'mautic.integration.customnavlinks' => [
                'class' => CustomNavlinksIntegration::class,
                'tags'  => [
                    'mautic.integration',
                    'mautic.basic_integration',
                ],
            ],
            'mautic.integration.customnavlinks.configuration' => [
                'class' => ConfigSupport::class,
                'tags'  => [
                    'mautic.config_integration',
                ],
            ],
        ],
    ],
    'routes' => [
        'main' => [
            'menuitem' => [
                'path'       => '/menuitem',
                'controller' => 'MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller\MenuItemController::indexAction',
            ],
            'createmenuitem' => [
                'path'       => '/createmenuitem',
                'controller' => 'MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller\MenuItemController::newAction',
            ],
            'deletemenuitem' => [
                'path'       => '/deletemenuitem{id}',
                'controller' => 'MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller\MenuItemController::deleteAction',
            ],
            'savemenuitem' => [
                'path'       => '/savemenuitem',
                'controller' => 'MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller\MenuItemController::saveAction',
            ],
        ],
    ],
];
