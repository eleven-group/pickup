<?php

namespace App\EventListener;

use App\Entity\Shop;
use App\Entity\Slot;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class shopCreateListener
{
    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Shop) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // Create slow

        $businessHours = $entity->getOpeningHours();

    }
}
