<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ShopRepository;
use App\DataFixtures\ProductFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(ShopRepository $ShopRepository)
    {
        $this->shopRepository = $ShopRepository;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $status = ['accepted', 'pending', 'canceled', 'done'];

        for ($i=2; $i < 1000; $i++) {


        $shop = $this->shopRepository->findOneBy(['id'=>rand(1,50)]);

        $date = $this->faker
                    ->dateTimeInInterval('now','+ 7 days')
                    ->format('Y-m-d H:i:s');

        $date = explode(' ', $date);
        $date = $date[0].' '.rand(13, 16).':'.$shop->getSlotRange().':00';

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $date);

        $phoneNumber = str_replace('+33', '0', $this->faker->mobileNumber);
        $phoneNumber = preg_replace('/\s+/', '', $phoneNumber);

        $booking = new Booking();

        $booking->setStatus($this->faker->randomElement($status));
        $booking->setDate($date);

        $booking->setShop($shop);

        $booking->setFirstname($this->faker->firstName);
        $booking->setLastname($this->faker->lastName);
        $booking->setEmail($this->faker->email);
        $booking->setPhonenumber(intval($phoneNumber));

        $manager->persist($booking);


        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
