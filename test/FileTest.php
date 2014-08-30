<?php

namespace BitWebTest\DoctrineExtension;

use BitWeb\DoctrineExtension\File;

class FileTest extends \PHPUnit_Framework_TestCase
{
    protected $fileName = 'testFile.txt';

    public function testConstruct()
    {
        $basePath = 'test/resources/';

        $file = new File($this->fileName, $basePath);

        $this->assertEquals($this->fileName, $file->getRelativeFileName());
        $this->assertEquals($basePath, $file->getBasePath());
        $this->assertFalse($file->isLoaded());
    }

    public function testConstructWithBasePathNull()
    {
        $file = new File($this->fileName);

        $this->assertNull($file->getBasePath());
    }
}
