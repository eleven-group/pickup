<?php 

namespace App\EventListener;

use App\Entity\User;
use App\Entity\Booking;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Service\Mailer;

class ResourceCreateEventListener
{

    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if (!$entity instanceof User && !$entity instanceof Booking) {
            return;
        }
        
        if ('cli' != php_sapi_name())
        {
            $templateId = $entity instanceof User ? 5 : 2;
            $params = $entity instanceof User ? 
            array(
                'token' => $entity->getToken(),
                'firstname' => $entity->getFirstname(),
                'lastname' => $entity->getLastname(),
            ) : 
            array(
                'shipping_date' => $entity->getDate(),
                'price' => $entity->getTotal(),
            );
            
            $this->mailer->sendMail($entity->getEmail(), $templateId, $params);
        }

    }
}