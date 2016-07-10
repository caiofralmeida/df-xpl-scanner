#!/usr/bin/env php

<?php

require __DIR__ . '/vendor/autoload.php';

use CaioFRAlmeida\DfXplScanner\Command\Finder;
use Symfony\Component\Console\Application;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$application = new Application();
$application->add(new Finder());
$application->run();
