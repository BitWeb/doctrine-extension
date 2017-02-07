<?php

namespace BitWeb\DoctrineExtension\Entity\Field;

use BitWeb\DoctrineExtension\DoctrineExtensionException;
use BitWeb\DoctrineExtension\Listener\Helper\TranslatableEntityHelper;
use BitWeb\DoctrineExtension\Listener\TranslatableListener;

class Translatable
{
    private $entity;

    private $fieldName;

    private $values = [];

    private $annotation;

    public function __construct($entity, $fieldName)
    {
        $this->entity = $entity;
        $this->fieldName = $fieldName;
    }

    private function getAnnotation()
    {
        if ($this->annotation == null) {
            $annotations = TranslatableEntityHelper::getFieldAnnotations($this->entity, $this->fieldName);

            foreach ($annotations as $annotation) {
                if (get_class($annotation) == TranslatableListener::MAPPING) {
                    $this->annotation = $annotation;
                    break;
                }
            }

            if ($this->annotation == null) {
                throw new DoctrineExtensionException('Field does not have Translatable mapping.');
            }
        }

        return $this->annotation;
    }

    public function get($languageIdentificator)
    {
        $fieldName = $this->getTranslatableField($languageIdentificator);
        if (isset($this->values[$fieldName])) {

            return $this->values[$fieldName];
        }

        return null;
    }

    public function set($value, $languageIdentificator)
    {
        $fieldName = $this->getTranslatableField($languageIdentificator, true);
        $this->values[$fieldName] = $value;

        $reflectionClass = TranslatableEntityHelper::getReflectionClass($this->entity);

        $property = $reflectionClass->getProperty($fieldName);
        $property->setAccessible(true);
        $property->setValue($this->entity, $value);
    }

    protected function getTranslatableField($languageIdentificator = null, $ignoreFallbacks = false)
    {
        $annotation = $this->getAnnotation();

        if ($languageIdentificator == null) {
            if (!isset($_SESSION[$annotation->variableName])) {
                throw new DoctrineExtensionException(
                    'Language variable "' . $annotation->variableName . '" not found in session.'
                );
            }
            $languageIdentificator = $_SESSION[$annotation->variableName];
        }

        $fieldName = $this->fieldName . ucfirst($languageIdentificator);

        if (!$ignoreFallbacks && isset($this->values[$annotation->default])) {

            if (isset($this->values[$fieldName]) && $this->values[$fieldName] == null) {

                if ($this->values[$annotation->default] != null) {
                    $fieldName = $annotation->default;
                } else {
                    foreach ($this->values as $fieldName => $value) {
                        if ($value != null) {

                            break;
                        }
                    }
                }
            }
        }

        $possibleFields = array_flip($annotation->fields);
        if (!isset($possibleFields[$fieldName])) {
            throw new DoctrineExtensionException(
                'Fieldname "' . $fieldName . '" on entity "' . get_class($this->entity) . '" does not exists.'
            );
        }

        return $fieldName;
    }

    public function setValues(array $values)
    {
        $this->values = $values;
    }

    public function getTranslatableFields()
    {
        return $this->getAnnotation()->fields;
    }
}
