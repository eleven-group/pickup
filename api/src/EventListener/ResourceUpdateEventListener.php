<?php

namespace App\EventListener;

use App\Entity\Booking;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Service\Mailer;

class ResourceUpdateEventListener
{

    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Booking) {
            return;
        }

            $templateId = $entity->getStatus() === 'accepted' ? 3 : 4;
            $params = $entity->getStatus() === 'accepted' ?
            array(
                'shipping_date' => $entity->getDate(),
                'price' => $entity->getTotal(),
            ) : array();

            $this->mailer->sendMail($entity->getEmail(), $templateId, $params);

    }
}
