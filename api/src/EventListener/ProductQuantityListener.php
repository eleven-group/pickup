<?php

namespace App\EventListener;

use App\Entity\BookingItem;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductQuantityListener
{
    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof BookingItem) {
            return;
        }

        $entityManager = $args->getObjectManager();

        dd($entity->getProduct());
    }
}
