<?php

use Pimple\Container;

$container = new Container();

$container->offsetSet('googleHtmlParser', function($container) {
    return new CaioFRAlmeida\DfXplScanner\Finder\Parser\GoogleHtmlPage(
        new \DOMDocument()
    );
});

$container->offsetSet('googleFinderProvider', function($container) {
    return new CaioFRAlmeida\DfXplScanner\Finder\Google(
        new GuzzleHttp\Client(),
        $container['googleHtmlParser']
    );
});
