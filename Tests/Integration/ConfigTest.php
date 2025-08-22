<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Tests\Integration;

use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Integration\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function getArray()
    {
        return [
            [
                "name"  => "asdasd",
                "url"   => "sadsad",
                "order" => 1,
                "type"  => "blank",
            ],
            [
                "name"  => "asdas",
                "url"   => "1sad",
                "order" => 1,
                "type"  => "blank",
            ],
            "integration" => [],
        ];
    }

    public function checkIfWeGetCorrectMenuItemArray() {
        $this->createMock();
        $config = new Config();

        $this->assertEquals($this->getAwaitedResult(), $result);
    }

    public function getAwaitedResult(){
        return   [
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