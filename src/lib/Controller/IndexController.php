<?php declare(strict_types=1);

namespace Jisse\Controller;

use Jisse\Model\Product;
use Jisse\Model\ProductLoader;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Loader\FilesystemLoader;

class IndexController
{
    public function __construct(
        private \Monolog\Logger $logger
    ) {
    }

    /**
     * @param string $templatesDir
     * @param bool $debug
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function output(string $templatesDir, \Monolog\Logger $logger, bool $debug = false): string
    {
        $logger->error('fsdf');

        $loader = new FilesystemLoader($templatesDir);
        $twig = new Environment($loader, ['debug' => $debug]);

        if ($debug) {
            $twig->addExtension(new DebugExtension());
        }

        $twig->addExtension(new MarkdownExtension());

        $products = (new ProductLoader())->getProducts();

        usort($products, function(Product $product1, Product $product2) {
            return strcmp($product1->getTitle(), $product2->getTitle());
        });

        return $twig->render('index.html.twig', ['products' => $products]);
    }
}