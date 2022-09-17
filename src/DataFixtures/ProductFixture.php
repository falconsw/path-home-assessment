<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $productsData = array(
            [
                "name" => "Product 1",
                "price" => 120.75,
                "stock" => 10
            ],
            [
                "name" => "Product 2",
                "price" => 49.50,
                "stock" => 10
            ]
        );

        foreach ($productsData as $row) {
            $product = new Product();
            $product->setName($row["name"]);
            $product->setPrice($row["price"]);
            $product->setStock($row["stock"]);
            $manager->persist($product);
        }
        $manager->flush();
    }
}
