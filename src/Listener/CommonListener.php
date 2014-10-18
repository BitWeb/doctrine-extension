<?php

namespace BitWeb\DoctrineExtension\Listener;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

abstract class CommonListener
{
    const MAPPING = null;

    protected static $mappingNames = [];

    private static $mappings = null;

    public function __construct($eventManager)
    {
        $this->init($eventManager);
        $this->addMappingNames();
    }

    abstract public function init(EventManager $eventManager);

    abstract protected function getMappingNames();

    protected function addMappingNames()
    {
        foreach ($this->getMappingNames() as $mappingName) {
            self::$mappingNames[$mappingName] = $mappingName;
        }
    }

    public static function getMappings(LifecycleEventArgs $eventArguments)
    {
        $meta = $eventArguments->getEntityManager()->getClassMetadata(get_class($eventArguments->getEntity()));
        $class = $meta->getReflectionClass();

        if (isset(self::$mappings[$class->getName()])) {

            return self::$mappings[$class->getName()];
        }
        self::$mappings[$class->getName()] = [];


        $reader = new CachedReader(
            new AnnotationReader(),
            $eventArguments->getEntityManager()->getConfiguration()->getMetadataCacheImpl()
        );

        foreach ($class->getProperties() as $property) {
            $annotations = $reader->getPropertyAnnotations($property);
            foreach ($annotations as $annotation) {
                if (isset(self::$mappingNames[get_class($annotation)])) {
                    self::$mappings[$class->getName()][get_class($annotation)][$property->getName()] = $annotation;
                }
            }
        }

        return self::$mappings[$class->getName()];
    }
}
