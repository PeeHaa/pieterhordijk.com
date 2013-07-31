<?php

namespace PieterHordijkTest\Mocks\Artax;

class Client extends \Artax\Client {
    function __construct(){}
    function request($uriOrRequest) {
        // Make this method do exactly what you want it to do
    }

    function requestMulti(array $requests, callable $onResult, callable $onError) {
        // Make this method call the $onResult or $onError callback as needed
    }
}
