<?php

namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration;

use Mautic\IntegrationsBundle\Integration\BasicIntegration;
use Mautic\IntegrationsBundle\Integration\ConfigurationTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\BasicInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormFeatureSettingsInterface;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Form\Type\FeatureSettingsType;


class CustomNavlinksIntegration extends BasicIntegration implements BasicInterface, ConfigFormFeatureSettingsInterface
{
    use ConfigurationTrait;

    public const INTEGRATION_NAME = 'customnavlinks';
    public const DISPLAY_NAME     = 'Custom Navlinks by Leuchtfeuer';

    public function getName(): string
    {
        return self::INTEGRATION_NAME;
    }

    public function getDisplayName(): string
    {
        return self::DISPLAY_NAME;
    }

    public function getIcon(): string
    {
        return 'plugins/LeuchtfeuerCustomNavlinksBundle/Assets/icon/Leuchtfeuer-mautic-CustomMenuItems.png';
    }

    public function getFeatureSettingsConfigFormName(): string
    {
        return FeatureSettingsType::class;
    }

}
