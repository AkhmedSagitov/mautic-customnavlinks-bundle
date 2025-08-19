<?php
namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\Support;

use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\CustomNavlinksIntegration;

class ConfigSupport extends CustomNavlinksIntegration implements ConfigFormInterface
{
    use DefaultConfigFormTrait;
}