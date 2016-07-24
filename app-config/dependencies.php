<?php

use Pimple\Container;

$container = new Container();

$container->offsetSet('googleFinderProvider', function($container){
    return new CaioFRAlmeida\DfXplScanner\Finder\Google(
        new GuzzleHttp\Client()
    );
});
