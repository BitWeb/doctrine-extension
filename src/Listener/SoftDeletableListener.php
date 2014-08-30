<?php

namespace BitWeb\DoctrineExtension\Listener;

use BitWeb\DoctrineExtension\Entity\SoftDeletable;
use BitWeb\DoctrineExtension\Mapping\SoftDeletable as SoftDeletableMapping;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

class SoftDeletableListener extends CommonListener
{
    const MAPPING = SoftDeletableMapping::class;

    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        /* @var $entity SoftDeletable */
        $entityManager = $eventArgs->getEntityManager();
        $unitOfWork = $eventArgs->getEntityManager()->getUnitOfWork();
        foreach ($unitOfWork->getScheduledEntityDeletions() as $entity) {
            if ($entity instanceof SoftDeletable) {
                $meta = $entityManager->getClassMetadata(get_class($entity));
                $entity->onDelete();
                $unitOfWork->computeChangeSet($meta, $entity);

                $entityManager->persist($entity);
                $unitOfWork->scheduleExtraUpdate($entity, $unitOfWork->getEntityChangeSet($entity));
            }
        }
    }

    public function init(EventManager $eventManager)
    {
        $eventManager->addEventListener(array(
            Events::onFlush,
        ), $this);
    }

    protected function getMappingNames()
    {
        return [self::MAPPING];
    }
}
