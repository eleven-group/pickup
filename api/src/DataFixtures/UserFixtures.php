<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private const ADMIN_ROLE = ['ROLE_ADMIN'];
    private const HR_MANAGER_ROLE = ['ROLE_HR_MANAGER'];
    private const EMPLOYEE_ROLE = ['ROLE_USER'];

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
        $adminUser = new User('admin');
        $adminUser->setBio("I'm an admin");
        $adminUser->setEmail('admin@wedigital.garden');
        $adminUser->setIsActive(true);
        $adminUser->setRoles(self::ADMIN_ROLE);

        $password = $this->encoder->encodePassword($adminUser, 'admin');
        $adminUser->setPassword($password);

        $manager->persist($adminUser);

        // Create a HR manager user
        $adminUser = new User('hr');
        $adminUser->setBio("I'm an HR manager");
        $adminUser->setEmail('hr@wedigital.garden');
        $adminUser->setIsActive(true);
        $adminUser->setRoles(self::HR_MANAGER_ROLE);

        $password = $this->encoder->encodePassword($adminUser, 'hr');
        $adminUser->setPassword($password);

        $manager->persist($adminUser);

        // Create an employee user
        $adminUser = new User('employee');
        $adminUser->setBio("I'm an employee");
        $adminUser->setEmail('employee@wedigital.garden');
        $adminUser->setIsActive(true);
        $adminUser->setRoles(self::EMPLOYEE_ROLE);

        $password = $this->encoder->encodePassword($adminUser, 'employee');
        $adminUser->setPassword($password);

        $manager->persist($adminUser);

        $manager->flush();
    }
}
