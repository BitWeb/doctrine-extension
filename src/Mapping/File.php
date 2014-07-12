<?php

namespace BitWeb\DoctrineExtension\Mapping;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
final class File extends Annotation
{

    public $relativeBasePath;
    public $classPath = null;
}
