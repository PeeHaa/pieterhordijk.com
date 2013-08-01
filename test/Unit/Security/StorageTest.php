<?php

namespace PieterHordijkTest\Unit\Security;

use PieterHordijk\Security\Storage;

class StorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PieterHordijk\Security\Storage::set
     */
    public function testSet()
    {
        $storage = new Storage();

        $this->assertNull($storage->set('key', 'value'));
    }

    /**
     * @covers PieterHordijk\Security\Storage::set
     * @covers PieterHordijk\Security\Storage::get
     */
    public function testGet()
    {
        $storage = new Storage();

        $this->assertNull($storage->set('key', 'value'));
        $this->assertSame('value', $storage->get('key'));
    }
}
