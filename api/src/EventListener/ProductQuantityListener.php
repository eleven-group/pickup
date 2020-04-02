<?php

namespace App\EventListener;

use App\Entity\BookingItem;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductQuantityListener
{

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        //when a booking is created, reduce the quantity of products available
        //when a booking is deleted, restore the quantity of products available

        if (!$entity instanceof BookingItem) {
            return;
        }

        $entityManager = $args->getObjectManager();

        dd($entity->getProduct());
    }
}

