<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private const ADMIN_ROLE = ['ROLE_ADMIN'];
    private const MANAGER_ROLE = ['ROLE_MANAGER'];
    private const USER_ROLE = ['ROLE_USER'];

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Create an admin user
        $user = new User('admin');
        $user->setEmail('admin@narah.io');
        $user->setIsActive(true);
        $user->setRoles(self::ADMIN_ROLE);

        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);

        // Create a HR manager user
        $user = new User('owner');
        $user->setEmail('owner@narah.io');
        $user->setIsActive(true);
        $user->setRoles(self::MANAGER_ROLE);

        $password = $this->encoder->encodePassword($user, 'owner');
        $user->setPassword($password);

        $manager->persist($user);

        // Create an employee user
        $user = new User('client');
        $user->setEmail('client@narah.io');
        $user->setIsActive(true);
        $user->setRoles(self::USER_ROLE);

        $password = $this->encoder->encodePassword($user, 'client');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
