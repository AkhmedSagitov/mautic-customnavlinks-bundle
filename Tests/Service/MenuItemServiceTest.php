<?php

namespace MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Tests\Service;

use MauticPlugin\LeuchtfeuerCustomMenuItemsBundle\Services\MenuItemService;
use PHPUnit\Framework\TestCase;

class MenuItemServiceTest extends TestCase
{


    public function testcheckIfWeGetCorrectMenuItemArray() {

        $service = new MenuItemService();
        $this->assertEquals($this->getAwaitedResult(), $service->buildArrayForMenuItem($this->getArray(),  1));
    }

    public function testIfWeGetPriorityListOfMuneItems()
    {
        $service = new MenuItemService();

        $this->assertEquals($this->getAwaitedMenuItemsPriority(), $service->getListPriorityOfMenuItems($this->getMenuItemsArray()));

    }


    public function getArray()
    {
        return
            [
                "name"  => "Test name",
                "url"   => "wwww.test.com",
                "order" => 1,
                "type"  => "_blank",
            ];
    }

    public function getAwaitedResult(){
        return  [
            'plugin.custom.menuitems.testname' => [
                'id'        => 'plugin.custom.menuitems.testname',
                'uri'     => 'wwww.test.com',
                'access'    => 'admin',
                'label'     => 'Test name',
                'iconClass' => 'ri-external-link-line',
                'linkAttributes' => [
                    'target' => '_blank',
                    'rel'    => 'noopener noreferrer'
                ],
                'priority' => 1,
            ],
        ];
    }


    public function getMenuItemsArray():array
    {
        return [
            'children' => [
                'mautic.dashboard.menu.index' => [
                    'route' => 'mautic_dashboard_index',
                    'iconClass' => 'ri-funds-fill',
                    'id' => 'mautic_dashboard_index',
                    'linkAttributes' => [
                        'data-menu-link' => 'mautic_dashboard_index',
                        'id' => 'mautic_dashboard_index',
                    ],
                    'extras' => [
                        'depth' => 0,
                        'iconClass' => 'ri-funds-fill',
                        'routeName' => 'mautic_dashboard_index',
                    ],
                    'priority' => 100,
                ],
                'mautic.lead.leads' => [
                    'iconClass' => 'ri-user-6-fill',
                    'access' => ['lead:leads:viewown', 'lead:leads:viewother'],
                    'route' => 'mautic_contact_index',
                    'priority' => 80,
                    'id' => 'mautic_contact_index',
                    'linkAttributes' => [
                        'data-menu-link' => 'mautic_contact_index',
                        'id' => 'mautic_contact_index',
                    ],
                    'extras' => [
                        'depth' => 0,
                        'iconClass' => 'ri-user-6-fill',
                        'routeName' => 'mautic_contact_index',
                    ],
                ],
                'mautic.companies.menu.index' => [
                    'route' => 'mautic_company_index',
                    'iconClass' => 'ri-building-2-fill',
                    'access' => ['lead:leads:viewother'],
                    'priority' => 75,
                    'id' => 'mautic_company_index',
                    'linkAttributes' => [
                        'data-menu-link' => 'mautic_company_index',
                        'id' => 'mautic_company_index',
                    ],
                    'extras' => [
                        'depth' => 0,
                        'iconClass' => 'ri-building-2-fill',
                        'routeName' => 'mautic_company_index',
                    ],
                ],
                'mautic.lead.list.menu.index' => [
                    'iconClass' => 'ri-pie-chart-fill',
                    'access' => ['lead:lists:viewown', 'lead:lists:viewother'],
                    'route' => 'mautic_segment_index',
                    'priority' => 70,
                    'id' => 'mautic_segment_index',
                    'linkAttributes' => [
                        'data-menu-link' => 'mautic_segment_index',
                        'id' => 'mautic_segment_index',
                    ],
                    'extras' => [
                        'depth' => 0,
                        'iconClass' => 'ri-pie-chart-fill',
                        'routeName' => 'mautic_segment_index',
                    ],
                ],
            ],
        ];
    }

    public function getAwaitedMenuItemsPriority() {

        return [
            1 => 100,
            2 => 80,
            3 => 75,
            4 => 70
        ];

    }

}