<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Services;

class MenuItemService
{

    public function buildArrayForMenuItem(array $menuItems) {

        $map = [];

            foreach($menuItems as $key => $item) {

                if ($key !== 'integration') {
                    $map['plugin.custom.navlinks.' . strtolower(str_replace(' ','',$item['name']))] = [
                        'id' => 'plugin.custom.navlinks.' . strtolower(str_replace(' ','',$item['name'])),
                        'uri' => $item['url'],
                        'access' => 'admin',
                        'label' => $item['name'],
                        'iconClass' => 'ri-external-link-line',
                        'linkAttributes' => [
                            'target' => '_blank',
                            'rel' => 'noopener noreferrer'
                        ],
                        'priority' => $item['order'],
                    ];
                }

            }

            return $map;
    }




}