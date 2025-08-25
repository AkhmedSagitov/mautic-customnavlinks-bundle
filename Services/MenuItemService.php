<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Services;

use Mautic\CoreBundle\Event\MenuEvent;

class MenuItemService
{

    public function buildArrayForMenuItem(array $menuItem, $priority) {

        $map = [];

            $map['plugin.custom.navlinks.' . strtolower(str_replace(' ','',$menuItem['name']))] = [
                'id' => 'plugin.custom.navlinks.' . strtolower(str_replace(' ','',$menuItem['name'])),
                'uri' => $menuItem['url'],
                'access' => 'admin',
                'label' => $menuItem['name'],
                'iconClass' => 'ri-external-link-line',
                'linkAttributes' => [
                    'target' => '_blank',
                    'rel' => 'noopener noreferrer'
                ],
                'priority' => $priority,
            ];

            return $map;
    }

    public function getListPriorityOfMenuItems(array $menuItems)
    {
        $priorities = [];

        $i = 1;

        foreach ($menuItems['children'] as $item) {
            $priorities[$i] =  $item['priority'];
            $i++;
        }

        return $priorities;
    }

    public function processMenuItems($itemsToAdd, MenuEvent $event)
    {
        foreach ($itemsToAdd as $key => $item) {

            if($key !== 'integration') {

                $listOfPriorities = $this->getListPriorityOfMenuItems($event->getMenuItems());

                $event->addMenuItems(
                    $this->buildArrayForMenuItem($item, $listOfPriorities[$item['order']] + 1)
                );

            }
        }
    }

}