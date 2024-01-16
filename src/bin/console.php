#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../app.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->addCommands([
        new \Jisse\Console\ProductCacheCommand()
]);

$application->run();