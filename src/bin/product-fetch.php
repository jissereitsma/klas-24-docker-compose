<?php

use Jisse\Model\ProductLoader;

require __DIR__ . '/../app.php';
$products = (new ProductLoader())->raw(false);
file_put_contents(__DIR__ . '/products.json', json_encode($products, JSON_PRETTY_PRINT));
