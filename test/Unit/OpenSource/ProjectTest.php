<?php

namespace PieterHordijkTest\Unit\OpenSource;

use PieterHordijk\OpenSource\Project;

class ProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     */
    public function testConstruct()
    {
        $project = new Project([], []);

        $this->assertInstanceOf('\\PieterHordijk\\OpenSource\\Project', $project);
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getId
     */
    public function testGetId()
    {
        $project = new Project(['id' => 11], []);

        $this->assertSame(11, $project->getId());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getName
     */
    public function testGetName()
    {
        $project = new Project(['name' => 'foo'], []);

        $this->assertSame('foo', $project->getName());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getSlug
     * @covers PieterHordijk\OpenSource\Project::getName
     * @covers PieterHordijk\OpenSource\Project::slugify
     */
    public function testGetSlug()
    {
        $project = new Project(['name' => 'Foo  with spaces é accents and what, not!'], []);

        $this->assertSame('foo-with-spaces-e-accents-and-what-not', $project->getSlug());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getShortDescription
     */
    public function testGetShortDescription()
    {
        $project = new Project(['description' => 'foo'], []);

        $this->assertSame('foo', $project->getShortDescription());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getLanguage
     */
    public function testGetLanguage()
    {
        $project = new Project([], ['language' => 'foo']);

        $this->assertSame('foo', $project->getLanguage());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getWatchers
     */
    public function testGetWatchers()
    {
        $project = new Project([], ['watchers' => 3]);

        $this->assertSame(3, $project->getWatchers());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getForks
     */
    public function testGetForks()
    {
        $project = new Project([], ['forks' => 13]);

        $this->assertSame(13, $project->getForks());
    }

    /**
     * @covers PieterHordijk\OpenSource\Project::__construct
     * @covers PieterHordijk\OpenSource\Project::getStatus
     */
    public function testGetStatus()
    {
        $project = new Project(['status' => 'foo'], []);

        $this->assertSame('foo', $project->getStatus());
    }
}
