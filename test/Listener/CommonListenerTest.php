<?php

namespace BitWebTest\DoctrineExtension\Listener;

use BitWebTest\DoctrineExtension\TestAsset\TestListener;
use Doctrine\Common\EventManager;

class CommonListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testAddMappingNames()
    {
        $eventManager = $this->getMockBuilder(EventManager::class)->disableOriginalConstructor()->getMock();

        $listener = new TestListener($eventManager);

        $this->callMethod($listener, 'addMappingNames');

        $expected = [
            '\Test\Mapping\File' => '\Test\Mapping\File'
        ];


        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($listener, 'mappingNames')
        );
    }

    protected function callMethod($object, $name, array $args = [])
    {
        $class = new \ReflectionClass($object);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }
}
