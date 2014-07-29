<?php

namespace BitWebTest\DoctrineExtension\TestAsset;

use BitWeb\DoctrineExtension\Listener\CommonListener;
use Doctrine\Common\EventManager;

class TestListener extends CommonListener
{
    protected $testMappingNames = [
        '\Test\Mapping\File'
    ];

    public function init(EventManager $eventManager)
    {
    }

    protected function getMappingNames()
    {
        return $this->testMappingNames;
    }

}
