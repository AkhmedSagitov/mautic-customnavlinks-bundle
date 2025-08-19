<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller;


use Mautic\CoreBundle\Controller\CommonController;
use Symfony\Component\HttpFoundation\Response;

class MenuItemController extends CommonController
{

    public function indexAction():Response
    {
        return $this->delegateView([
            'viewParameters'  => [
                'message' => 'Hello Item',
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }
}