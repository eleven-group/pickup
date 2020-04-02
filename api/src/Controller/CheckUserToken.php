<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;

class CheckUserToken
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Request $request, EntityManagerInterface $entityManager): User
    {
        $token = $request->query->get('token');
        try {
            $user = $this->userRepository->findOneBy(['token' => $token]);
            $user->setIsActive(true);
            $user->setToken(null);
            $entityManager->persist($user);
            $entityManager->flush();

            return $user;
        }
        catch(Exception $e) {
            throw new Exception($e, "The user can't be found.");
        }
    }
}
