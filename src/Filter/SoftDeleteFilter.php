<?php

namespace BitWeb\DoctrineExtension\Filter;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\ClassMetaData;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDeleteFilter extends SQLFilter
{

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if (!in_array('BitWeb\DoctrineExtension\Entity\SoftDeletable', $targetEntity->reflClass->getInterfaceNames())) {
            return '';
        }

        $class = $targetEntity->getReflectionClass();
        $reader = new AnnotationReader();

        $constraint = '';
        $isFirst = true;
        foreach ($class->getProperties() as $property) {
            if ($reader->getPropertyAnnotation($property, 'BitWeb\DoctrineExtension\Mapping\SoftDeletable') !== null) {
                $constraint .= ($isFirst ? '' : ' AND ') . $targetTableAlias . '.' . $targetEntity->getColumnName($property->getName()) . ' IS NULL';
                $isFirst = false;
            }
        }

        return $constraint;
    }
}
