<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    private $objectManager;
    public function __construct(EntityManagerInterface $objectManager, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();
        $this->encoder = $encoder;
        $this->objectManager = $objectManager;
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('user:create')
            ->setDescription('create the specified user.')
            ->setHelp('This command allow you to create an user.')
            ->setDefinition(array(
                new InputArgument('email', InputArgument::REQUIRED, 'email : '),
                new InputArgument('username', InputArgument::REQUIRED, 'username : '),
                new InputArgument('password', InputArgument::REQUIRED, 'password : '),
                new InputArgument('firstname', InputArgument::REQUIRED, 'firstname : '),
                new InputArgument('lastname', InputArgument::REQUIRED, 'lastname : '),
            ))
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '==============================',
            '        Create a user        ',
            '==============================',
            '',
        ]);

        $user = new User();

        $password = $this->encoder->encodePassword($user, $input->getArgument('password'));

        $user->setEmail($input->getArgument('email'));
        $user->setFirstname($input->getArgument('firstname'));
        $user->setLastname($input->getArgument('lastname'));
        $user->setUsername($input->getArgument('username'));
        $user->setRoles(["ROLE_ADMIN"]);

        $user->setPassword($password);

        $this->objectManager->persist($user);
        $this->objectManager->flush();

        $output->writeln("<comment>User " . $user->getEmail() . " has been created </comment> \n");
    }
}


