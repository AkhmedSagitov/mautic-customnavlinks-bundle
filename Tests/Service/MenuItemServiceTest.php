<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Tests\Service;

use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Services\MenuItemService;
use PHPUnit\Framework\TestCase;

class MenuItemServiceTest extends TestCase
{
    public function getArray()
    {
        return [
            [
                "name"  => "Test name",
                "url"   => "wwww.test.com",
                "order" => 1,
                "type"  => "_blank",
            ],
            [
                "name"  => "Test name2",
                "url"   => "wwww.test.com2",
                "order" => 2,
                "type"  => "_blank",
            ],
            "integration" => [],
        ];
    }

    public function testcheckIfWeGetCorrectMenuItemArray() {
        $service = new MenuItemService();
        $this->assertEquals($this->getAwaitedResult(), $service->buildArrayForMenuItem($this->getArray()));
    }

    public function getAwaitedResult(){
        return  [
            'plugin.custom.navlinks.testname' => [
                'id'        => 'plugin.custom.navlinks.testname',
                'uri'     => 'wwww.test.com',
                'access'    => 'admin',
                'label'     => 'Test name',
                'iconClass' => 'fa-globe',
                'linkAttributes' => [
                    'target' => '_blank',
                    'rel'    => 'noopener noreferrer'
                ],
                'priority' => 1,
            ],
            'plugin.custom.navlinks.testname2' => [
                'id'        => 'plugin.custom.navlinks.testname2',
                'uri'     => 'wwww.test.com2',
                'access'    => 'admin',
                'label'     => 'Test name2',
                'iconClass' => 'fa-globe',
                'linkAttributes' => [
                    'target' => '_blank',
                    'rel'    => 'noopener noreferrer'
                ],
                'priority' => 2,
            ]
        ];
    }
}