<?php

namespace App\AdminCore\Fixtures;

use App\AdminCore\Entity\Product;

class ProductFixtures extends AbstractFixtures
{
    public function create(): Product
    {
        return (new Product)
            ->setName($this->generate()->company())
            ->setPrice($this->generate()->numberBetween(100, 9999))
            ->setDescription($this->generate()->text(255));
    }
}