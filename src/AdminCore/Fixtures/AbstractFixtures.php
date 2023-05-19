<?php

namespace App\AdminCore\Fixtures;

use Faker\Factory;
use Faker\Generator;

class AbstractFixtures
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function generate(): Generator
    {
        return $this->faker;
    }
}