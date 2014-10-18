<?php
namespace BitWeb\DoctrineExtension\Listener;

use BitWeb\DoctrineExtension\Mapping\File;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class FileListener extends CommonListener
{
    const MAPPING = File::class;

    private $isUpdated = false;

    public function init(EventManager $eventManager)
    {
        $eventManager->addEventListener([
            Events::postUpdate,
            Events::postRemove,
            Events::postPersist,
        ], $this);
    }

    protected function getMappingNames()
    {
        return [self::MAPPING];
    }

    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $this->isUpdated = false;
        $this->insertUpdateAction($eventArgs);
    }

    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $this->insertUpdateAction($eventArgs);
    }

    public function postRemove(LifecycleEventArgs $eventArguments)
    {
        $entity = $eventArguments->getEntity();

        $mappings = self::getMappings($eventArguments);

        if (isset($mappings[self::MAPPING])) {
            foreach ($mappings[self::MAPPING] as $fieldName => $annotation) {
                $getter = 'get' . ucfirst($fieldName);
                if ($entity->$getter() != null) {
                    $entity->$getter()->delete();
                }
            }
        }
    }

    protected function insertUpdateAction(LifecycleEventArgs $eventArguments)
    {
        if ($this->isUpdated) {
            return null;
        }

        $entity = $eventArguments->getEntity();
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $eventArguments->getEntityManager();
        $mappings = self::getMappings($eventArguments);
        if (isset($mappings[self::MAPPING])) {
            foreach ($mappings[self::MAPPING] as $fieldName => $annotation) {
                $setter = 'set' . ucfirst($fieldName);
                $getter = 'get' . ucfirst($fieldName);

                if ($entity->$getter() != null) {
                    $entity->$getter()->setClassPath($annotation->classPath);
                    $entity->$getter()->setRelativeBasePath($annotation->relativeBasePath);

                    $entity->$setter($entity->$getter()
                        ->autoRename($entity, $fieldName));
                }
            }

            $this->isUpdated = true;
            $em->persist($entity);
            $em->flush();
        }
    }

}
