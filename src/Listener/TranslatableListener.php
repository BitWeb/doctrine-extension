<?php

namespace BitWeb\DoctrineExtension\Listener;

use BitWeb\DoctrineExtension\Entity\Field\Translatable;
use BitWeb\DoctrineExtension\Mapping\Translatable as TranslatableMapping;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class TranslatableListener extends CommonListener
{
    const MAPPING = TranslatableMapping::class;

    public function init(EventManager $eventManager)
    {
        $eventManager->addEventListener([
            Events::postLoad,
        ], $this);
    }

    protected function getMappingNames()
    {
        return [self::MAPPING];
    }

    public function postLoad(LifecycleEventArgs $eventArgs)
    {
        $this->postLoadAction($eventArgs);
    }

    protected function postLoadAction(LifecycleEventArgs $eventArguments)
    {
        $entity = $eventArguments->getEntity();
        $em = $eventArguments->getEntityManager();
        $entityReflection = $em->getClassMetadata(get_class($entity))->getReflectionClass();

        $mappings = self::getMappings($eventArguments);

        if (isset($mappings[self::MAPPING])) {

            foreach ($mappings[self::MAPPING] as $fieldName => $annotation) {
                $translatable = new Translatable($entity, $fieldName);

                $values = [];
                foreach ($translatable->getTranslatableFields() as $translatableField) {
                    $property = $entityReflection->getProperty($translatableField);
                    $property->setAccessible(true);
                    $values[$translatableField] = $property->getValue($entity);
                }

                $translatable->setValues($values);

                $property = $entityReflection->getProperty($fieldName);
                $property->setAccessible(true);
                $property->setValue($entity, $translatable);
            }
        }
    }
}
