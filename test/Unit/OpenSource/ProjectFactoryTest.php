<?php

namespace PieterHordijkTest\Unit\OpenSource;

use PieterHordijk\OpenSource\ProjectFactory;

class ProjectFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PieterHordijk\OpenSource\ProjectFactory::build
     */
    public function testBuild()
    {
        $factory = new ProjectFactory();

        $this->assertInstanceOf('\\PieterHordijk\\OpenSource\\ProjectFactory', $factory);
        $this->assertInstanceOf('\\PieterHordijk\\OpenSource\\Project', $factory->build([], []));
    }
}
