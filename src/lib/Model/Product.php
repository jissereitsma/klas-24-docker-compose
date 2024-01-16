<?php declare(strict_types=1);

namespace Jisse\Model;

class Product
{
    public function __construct(
        private string $title,
        private string $description,
        private string $thumbnail
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }
}