<?php

namespace BitWeb\DoctrineExtension\Mapping;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
final class Translatable extends Annotation
{
    public $fields = [];

    public $default; // If isset, takes the first value that is not null, otherwise ignoreFallbacks

    public $variableName = 'language';
}
