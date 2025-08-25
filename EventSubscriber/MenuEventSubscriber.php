<?php

namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\EventSubscriber;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\MenuEvent;
use Mautic\IntegrationsBundle\Helper\IntegrationsHelper;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration\CustomNavlinksIntegration;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Services\MenuItemService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private MenuItemService $menuItemService, private IntegrationsHelper $integrationsHelper)
    {

    }
    public static function getSubscribedEvents()
    {
        return [
            CoreEvents::BUILD_MENU => ['onBuildMenu', 999],
        ];
    }

    public function onBuildMenu(MenuEvent $event)
    {

        if ($event->getType() == 'main') {

            $integrationConfiguration = $this->integrationsHelper->getIntegration(CustomNavlinksIntegration::INTEGRATION_NAME)->getIntegrationConfiguration();

            if($integrationConfiguration->getIsPublished()) {
                  $this->menuItemService->processMenuItems($integrationConfiguration->getFeatureSettings(), $event);
            }
        }
    }
}
