<?php
namespace BitWeb\DoctrineExtension\Listener;

use Doctrine\Common\EventManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class UserAgentListener extends CommonListener
{
    const MAPPING = 'BitWeb\DoctrineExtension\Mapping\UserAgent';

    public function init(EventManager $eventManager)
    {
        $eventManager->addEventListener([
            Events::prePersist,
        ], $this);
    }

    protected function getMappingNames()
    {
        return [self::MAPPING];
    }

    public function prePersist(LifecycleEventArgs $eventArguments)
    {
        $entity = $eventArguments->getEntity();
        $mappings = $this->getMappings($eventArguments);
        if (isset($mappings[self::MAPPING])) {
            foreach ($mappings[self::MAPPING] as $name => $annotation) {
                $entityReflection = $eventArguments->getEntityManager()->getClassMetadata(get_class($entity))->getReflectionClass();
                $property = $entityReflection->getProperty($name);
                $property->setAccessible(true);
                if ($property->getValue($entity) == null) {
                    $property->setValue($entity, !isset($_SERVER['HTTP_USER_AGENT']) ?: $_SERVER['HTTP_USER_AGENT']);
                }
            }
        }
    }
}
