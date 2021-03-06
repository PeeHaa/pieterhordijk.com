<?php

namespace PieterHordijkTest\Unit\OpenSource;

use PieterHordijk\OpenSource\Collection,
    PieterHordijkTest\Mocks\Db\Pdo,
    PieterHordijkTest\Mocks\Artax\Client;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PieterHordijk\OpenSource\Collection::__construct
     */
    public function testConstruct()
    {
        $clientMock  = new Client();
        $factoryMock = $this->getMock('\\PieterHordijk\\OpenSource\\ProjectFactory');
        $storageMock = $this->getMock('\\PieterHordijk\\Security\\Storage');

        $collection = new Collection(new Pdo(), $clientMock, $factoryMock, $storageMock);

        $this->assertInstanceOf('\\PieterHordijk\\OpenSource\\Collection', $collection);
    }
}
