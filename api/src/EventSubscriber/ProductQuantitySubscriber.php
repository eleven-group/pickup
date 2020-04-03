<?php

namespace App\EventSubscriber;

use App\Entity\Booking;
use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductQuantitySubscriber implements EventSubscriber
{

    public function getSubscribedEvents()
    {
        return [
            Events::postUpdate,
        ];
    }
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Booking) {
            return;
        }

        $pr = $args->getEntityManager()->getRepository(Product::class);

        if($entity->getStatus() === "accepted"){
            $pr->updateQuantity($entity->getId(), "-");
        }

        if($entity->getStatus() === "canceled"){
            $pr->updateQuantity($entity->getId(), "+");
        }
    }
}
