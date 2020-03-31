<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\UserRepository;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ShopFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {

        $businessHours = [
            "mon" => ["9:00-12:00","14:00-18:00"],
            "tue" => ["9:00-12:00","14:00-18:00"],
            "wen" => ["9:00-12:00","14:00-18:00"],
            "thu" => ["9:00-12:00","14:00-18:00"],
            "fri" => ["9:00-12:00","14:00-18:00"]
        ];


        for ($i=2; $i < 52; $i++) {

        $user = $this->userRepository->findOneBy(['id'=>$i]);


        $shop = new Shop();
        $shop->setName($this->faker->company);
        $shop->setDescription($this->faker->catchPhrase);

        $shop->setIsActive(true);
        $shop->setOpeningHours($businessHours);


        $geocode = $this->faker->latitude(-90,90).', '.$this->faker->longitude(-180,180);

        $shop->setGeocode($geocode);
        $shop->setPostalCode($this->faker->postcode);
        $shop->setCity($this->faker->city);
        $shop->setStreetAdress($this->faker->streetAddress);
        $shop->setOwner($user);

        $shop->setSlotRange($this->faker->randomElement([10,15,20,25]));

        $manager->persist($shop);

        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
