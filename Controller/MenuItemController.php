<?php

namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;
use Mautic\IntegrationsBundle\Helper\IntegrationsHelper;
use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Integration\CustomMenuItemsIntegration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuItemController extends CommonController
{

    public function indexAction(IntegrationsHelper $integrationsHelper): Response
     {
         $items = $integrationsHelper->getIntegration(CustomMenuItemsIntegration::INTEGRATION_NAME)->getIntegrationConfiguration()->getFeatureSettings();

         return $this->delegateView([
             'viewParameters'  => [
                 'items' => $items,
             ],
             'contentTemplate' => '@LeuchtfeuerCustomMenuItems/CreateMenu/index.html.twig',
         ]);
     }


     public function saveAction(Request $request, IntegrationsHelper $integrationsHelper): Response
    {
        if ($request->isMethod('POST')) {

            $itemsData = $request->request->get('items', []);

            if (is_array($itemsData)) {
                usort($itemsData, function($a, $b) {
                    return $a['order'] <=> $b['order'];
                });
            }

            $integrationEntity = $integrationsHelper->getIntegration(CustomMenuItemsIntegration::INTEGRATION_NAME)->getIntegrationConfiguration();
            $integrationEntity->setFeatureSettings($itemsData);
            $integrationsHelper->saveIntegrationConfiguration($integrationEntity);
        }


        return $this->json(['status' => 'success']);
    }

}