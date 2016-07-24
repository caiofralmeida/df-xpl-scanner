#!/usr/bin/env php

<?php

require __DIR__ . '/vendor/autoload.php';

// container loads
require __DIR__ . '/app-config/dependencies.php';

use CaioFRAlmeida\DfXplScanner\Command\Finder;
use Symfony\Component\Console\Application;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$application = new Application();
$application->add(new Finder($container['googleFinderProvider']));
$application->run();
