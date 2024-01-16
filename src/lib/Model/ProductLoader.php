<?php declare(strict_types=1);

namespace Jisse\Model;

class ProductLoader
{
    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        $productsData = $this->raw();
        $products = [];
        foreach ($productsData as $productData) {
            $products[] = new Product(
                $productData['title'],
                $productData['description'],
                $productData['thumbnail']
            );
        }

        return $products;
    }

    private function getDescriptionFromArray(array $data): string
    {
        if (isset($data['description'])) {
            return $data['description'];
        }

        return '';
    }

    /**
     * @return Product[]
     */
    public function raw($useCache = true): array
    {
        $cacheFile = __DIR__ . '/../bin/products.json';
        if (true === $useCache && is_file($cacheFile)) {
            $data = json_decode(file_get_contents($cacheFile), true);
            if (!empty($data)) {
                return $data;
            }
        }

        $url = 'https://dummyjson.com/products';


        $json = file_get_contents($url);

        $data = json_decode($json, true);
        return $data['products'];
    }
}