<?php

declare(strict_types=1);

use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration\CustomMenuItemsIntegration;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration\Support\ConfigSupport;


return [
    'name'        => 'Custom Menu Items by Leuchtfeuer',
    'description' => 'Custom Menu Items by Leuchtfeuer',
    'version'     => '1.0.0',
    'author'      => 'Leuchtfeuer Digital Marketing GmbH',
    'services'    => [
        'integrations' => [
            'mautic.integration.custommenuitems' => [
                'class' => CustomMenuItemsIntegration::class,
                'tags'  => [
                    'mautic.integration',
                    'mautic.basic_integration',
                ],
            ],
            'mautic.integration.custommenuitems.configuration' => [
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
                'controller' => 'MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Controller\MenuItemController::indexAction'
            ],
            'savemenuitem' => [
                'path'       => '/savemenuitem',
                'controller' => 'MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Controller\MenuItemController::saveAction',
            ],
        ],
    ],
];
