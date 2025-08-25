<?php
namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration\Support;

use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration\CustomMenuItemsIntegration;

class ConfigSupport extends CustomMenuItemsIntegration implements ConfigFormInterface
{
    use DefaultConfigFormTrait;
}