<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\EventSubscriber;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\MenuEvent;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\Config;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private Config $config
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            CoreEvents::BUILD_MENU => ['onBuildMenu', 999],
        ];
    }

    public function onBuildMenu(MenuEvent $event)
    {
        $event->addMenuItems([
            'items' => [
                'plugin.helloworld.index2' => [
                    'id'        => 'plugin_helloworld_index2',
                    'route'     => 'menuitem',
                    'access'    => 'admin',
                    'label'     => 'Hello World dynamic',
                    'iconClass' => 'fa-globe',
                ],
            ],
        ]);
    }
}
