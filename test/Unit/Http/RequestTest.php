<?php

namespace PieterHordijkTest\Unit\Http;

use PieterHordijk\Http\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $serverVariables;
    protected $getVariables;
    protected $postVariables;
    protected $cookieVariables;

    public function setUp()
    {
        $this->serverVariables = \PieterHordijkTest\getTestDataFromFile(PIETERHORDIJK_TEST_DATA_DIR . '/Http/server-variables.php');
        $this->getVariables    = \PieterHordijkTest\getTestDataFromFile(PIETERHORDIJK_TEST_DATA_DIR . '/Http/get-variables.php');
        $this->postVariables   = \PieterHordijkTest\getTestDataFromFile(PIETERHORDIJK_TEST_DATA_DIR . '/Http/post-variables.php');
        $this->cookieVariables = ['key' => 'value'];
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     */
    public function testConstructCorrectInterface()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertInstanceOf('\\PieterHordijk\\Http\\Request', $request);
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPath
     */
    public function testGetPath()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('/some/deep/path', $request->getPath());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getGetVariables
     */
    public function testGetGetVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->getVariables, $request->getGetVariables());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getGetVariable
     */
    public function testGetGetVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('value1', $request->getGetVariable('var1'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getGetVariable
     */
    public function testGetGetVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getGetVariable('var99'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getGetVariable
     */
    public function testGetGetVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getGetVariable('var99', 'nonDefault'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPostVariables
     */
    public function testGetPostVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->postVariables, $request->getPostVariables());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPostVariable
     */
    public function testGetPostVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('postvalue1', $request->getPostVariable('postvar1'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPostVariable
     */
    public function testGetPostVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getPostVariable('postvar99'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPostVariable
     */
    public function testGetPostVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getPostVariable('postvar99', 'nonDefault'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getCookieVariables
     */
    public function testGetCookieVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->cookieVariables, $request->getCookieVariables());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getCookieVariable
     */
    public function testGetCookieVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('value', $request->getCookieVariable('key'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getCookieVariable
     */
    public function testGetCookieVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getCookieVariable('cookievar99'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getCookieVariable
     */
    public function testGetCookieVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getCookieVariable('postvar99', 'nonDefault'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPathVariables
     */
    public function testGetPathVariablesWithoutPathVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame([], $request->getPathVariables());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getPostVariable('unknown_var'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getPathVariable('unknown_var', 'nonDefault'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getServerVariables
     */
    public function testGetServerVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->serverVariables, $request->getServerVariables());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getServerVariable
     */
    public function testGetServerVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('example.com', $request->getServerVariable('SERVER_NAME'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getServerVariable
     */
    public function testGetServerVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getServerVariable('unknownservervariable'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getServerVariable
     */
    public function testGetServerVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getServerVariable('unknownservervariable', 'nonDefault'));
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getMethod
     */
    public function testGetMethod()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('POST', $request->getMethod());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::getHost
     */
    public function testGetHost()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('www.example.com', $request->getHost());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::isSsl
     */
    public function testIsSslWithOn()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertTrue($request->isSsl());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::isSsl
     */
    public function testIsSslWithOff()
    {
        $serverVariables = $this->serverVariables;
        $serverVariables['HTTPS'] = 'off';

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertFalse($request->isSsl());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::isSsl
     */
    public function testIsSslWithoutValue()
    {
        $serverVariables = $this->serverVariables;
        $serverVariables['HTTPS'] = '';

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertFalse($request->isSsl());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::isSsl
     */
    public function testIsSslWithSomeString()
    {
        $serverVariables = $this->serverVariables;
        $serverVariables['HTTPS'] = 'somerandomstring';

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertTrue($request->isSsl());
    }

    /**
     * @covers PieterHordijk\Http\Request::__construct
     * @covers PieterHordijk\Http\Request::setPath
     * @covers PieterHordijk\Http\Request::getBarePath
     * @covers PieterHordijk\Http\Request::isSsl
     */
    public function testIsSslWithoutHttpsKey()
    {
        $serverVariables = $this->serverVariables;
        unset($serverVariables['HTTPS']);

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertFalse($request->isSsl());
    }
}
