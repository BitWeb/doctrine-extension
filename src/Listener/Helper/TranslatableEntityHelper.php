<?php

namespace BitWeb\DoctrineExtension\Listener\Helper;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\ORM\EntityManager;

class TranslatableEntityHelper
{
    /**
     * @var EntityManager
     */
    private static $entityManager;

    public static function setEntityManager(EntityManager $entityManager)
    {
        self::$entityManager = $entityManager;
    }

    public static function getReflectionClass($entity)
    {
        return self::$entityManager->getClassMetadata(get_class($entity))->getReflectionClass();
    }

    public static function getFieldAnnotations($entity, $fieldName)
    {
        $class = self::getReflectionClass($entity);

        $reader = new CachedReader(
            new AnnotationReader(),
            self::$entityManager->getConfiguration()->getMetadataCacheImpl()
        );

        $annotations = $reader->getPropertyAnnotations($class->getProperty($fieldName));

        return $annotations;
    }
}
