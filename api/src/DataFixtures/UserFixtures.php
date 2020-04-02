<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private const ADMIN_ROLE = ['ROLE_ADMIN'];
    private const MANAGER_ROLE = ['ROLE_MANAGER'];
    private const USER_ROLE = ['ROLE_USER'];

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Faker\Factory::create('fr_FR');
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Create an admin user
        $user = new User();
        $user->setUsername($this->faker->username);
        $user->setFirstname($this->faker->firstName);
        $user->setLastname($this->faker->lastName);
        $user->setEmail('admin@narah.io');
        $user->setIsActive(true);
        $user->setRoles(self::ADMIN_ROLE);

        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);


        for ($i=0; $i < 50; $i++) {

            $user = new User();
            $user->setUsername($this->faker->username);
            $user->setFirstname($this->faker->firstName);
            $user->setLastname($this->faker->lastName);
            $user->setEmail($this->faker->email);
            $user->setIsActive(true);
            $user->setRoles(self::MANAGER_ROLE);

            $password = $this->encoder->encodePassword($user, 'owner');
            $user->setPassword($password);

            $manager->persist($user);

        }


        $manager->flush();
    }
}
