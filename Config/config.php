<?php

declare(strict_types=1);

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
    'menu' => [
        'admin' => [
            'mautic.menuItem' => [
                'route'     => 'menuitem',
                'label'     => 'Menu item',
                'parent'    => 'mautic.core.general',
                'priority'  => 60,
                'iconClass' => 'fa fa-link',
                'access'    => 'admin',
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
        ],
    ],
];
