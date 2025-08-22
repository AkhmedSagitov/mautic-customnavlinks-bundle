<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration;

use Mautic\IntegrationsBundle\Exception\IntegrationNotFoundException;
use Mautic\IntegrationsBundle\Helper\IntegrationsHelper;
use Mautic\PluginBundle\Entity\Integration;

class Config
{
    public function __construct(
        private IntegrationsHelper $integrationsHelper,
    ) {
    }

    public function isPublished(): bool
    {
        try {
            $integration = $this->getIntegrationEntity();

            return (bool) $integration->getIsPublished();
        } catch (IntegrationNotFoundException) {
            return false;
        }
    }

    /**
     * @throws IntegrationNotFoundException
     */
    public function getIntegrationEntity(): Integration
    {
        return $this->integrationsHelper->getIntegration(CustomNavlinksIntegration::INTEGRATION_NAME)->getIntegrationConfiguration();
    }


    public function prepareMenuItemArray(): array
    {

        try {
            $integration     = $this->getIntegrationEntity();
            $featureSettings = $integration->getFeatureSettings();
        } catch (IntegrationNotFoundException) {
            // Ignore if integration not found
        }
        return      [
            'priority' => 11,
            'items'    => [
                'plugin.helloworld.index2' => [
                    'id'        => 'plugin_helloworld_index2',
                    'route'     => 'menuitem',
                    'access'    => 'admin',
                    'label'     => 'Hello World dynamic',
                    'iconClass' => 'fa-globe',
                    'priority'  => 11,
                ],
            ],
        ];
    }
}