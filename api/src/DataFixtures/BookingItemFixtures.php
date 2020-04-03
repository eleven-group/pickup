<?php

namespace App\DataFixtures;

use App\Entity\BookingItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\BookingRepository;
use App\Repository\ProductRepository;
use App\DataFixtures\BookingFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class BookingItemFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(BookingRepository $bookingRepository, ProductRepository $productRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->productRepository = $productRepository;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $status = ['accepted', 'pending', 'canceled', 'done'];

        for ($i=1; $i < 3000; $i++) {

        $booking = $this->bookingRepository->findOneBy(['id'=>rand(1,1000)]);
        $product = $this->productRepository->findOneBy(['id'=>rand(1,50)]);

        $bookingItem = new BookingItem;

        $bookingItem->setQuantity(rand(1, 10));
        $bookingItem->setPrice(rand(1, 1000));
        $bookingItem->setProduct($product);
        $bookingItem->setBooking($booking);

        $manager->persist($bookingItem);

        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            BookingFixtures::class,
        ];
    }
}
