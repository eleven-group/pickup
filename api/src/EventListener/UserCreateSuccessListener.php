<?php 

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Service\Mailer;

class UserCreateSuccessListener
{

    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        $this->mailer->sendMail($entity->getEmail(), 5, array(
            'token' => $entity->getToken(),
            'firstname' => $entity->getFirstname(),
            'lastname' => $entity->getLastname(),
        ));

    }
}