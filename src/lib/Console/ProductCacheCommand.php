<?php
declare(strict_types=1);

namespace Jisse\Console;

use Jisse\Model\ProductLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductCacheCommand extends Command
{
    protected function configure()
    {
        $this->setName('product:fetch');
        $this->setDescription('Generate product cache');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('sdffsd');
        $products = (new ProductLoader())->raw(false);
        file_put_contents(BP . '/bin/products.json', json_encode($products, JSON_PRETTY_PRINT));


        return 0;
    }
}

