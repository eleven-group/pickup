<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\UserRepository;

class ShopFixtures extends Fixture
{

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

        $user = $this->userRepository->findOneBy(['email'=>'owner@narah.io']);

        $shop = new Shop();
        $shop->setName('Bistrot Burger');
        $shop->setDescription("This is a shop");

        $shop->setIsActive(true);
        $shop->setOpeningHours($businessHours);


        $shop->setGeocode('48.8716176, 2.3411379');
        $shop->setPostalCode('75002');
        $shop->setCity('Paris');
        $shop->setStreetAdress('40 Rue du Louvre');
        $shop->setOwner($user);

        $manager->persist($shop);

        $manager->flush();

    }
}
