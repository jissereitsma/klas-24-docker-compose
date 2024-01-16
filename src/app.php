<?php
declare(strict_types=1);

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

define('BP', __DIR__);

require BP . '/vendor/autoload.php';
require BP . '/config.php';

/** @var string $templatesDir */
/** @var bool $debug */
if (empty($templatesDir)) {
    throw new RuntimeException('Templates directory is not set');
}


$logger = new Logger('myapp');
$logger->pushHandler(new StreamHandler(BP.'/app.log', Level::Warning));
