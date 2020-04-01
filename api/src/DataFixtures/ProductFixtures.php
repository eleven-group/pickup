<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ShopRepository;
use App\DataFixtures\ShopFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(ShopRepository $ShopRepository)
    {
        $this->ShopRepository = $ShopRepository;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {

        for ($i=2; $i < 52; $i++) {

        $shop = $this->ShopRepository->findOneBy(['id'=>$i]);


        $product = new Product();
        $product->setName($this->faker->words(rand(1, 5), true));
        $product->setDescription($this->faker->text(rand(10, 200)));
        $product->setPrice($this->faker->numberBetween(100, 10000));
        $product->setQuantity($this->faker->numberBetween(1, 200));
        $product->setShop($shop);

        $manager->persist($product);

        $product = new Product();
        $product->setName($this->faker->words(rand(1, 5), true));
        $product->setDescription($this->faker->text(rand(10, 200)));
        $product->setPrice($this->faker->numberBetween(100, 10000));
        $product->setQuantity($this->faker->numberBetween(1, 200));
        $product->setShop($shop);

        $manager->persist($product);

        $product = new Product();
        $product->setName($this->faker->words(rand(1, 5), true));
        $product->setDescription($this->faker->text(rand(10, 200)));
        $product->setPrice($this->faker->numberBetween(100, 10000));
        $product->setQuantity($this->faker->numberBetween(1, 200));
        $product->setShop($shop);

        $manager->persist($product);


        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            ShopFixtures::class,
        ];
    }
}
