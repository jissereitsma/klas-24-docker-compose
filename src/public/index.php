<?php
declare(strict_types=1);


require __DIR__ . '/../app.php';

/** @var string $templatesDir */
/** @var bool $debug */
/** @var \Monolog\Logger $logger */
$renderer = new \Jisse\Controller\IndexController($logger);
echo $renderer->output($templatesDir, $logger, $debug);

