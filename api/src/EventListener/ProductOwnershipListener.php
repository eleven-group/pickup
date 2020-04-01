<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProductOwnershipListener
{
    public function __construct(TokenStorageInterface $tokenStorage = null)
    {
        $this->tokenStorage = $tokenStorage;
    }

    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Product) {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if(null === $entity->getShop()){
            $shop = $user->getShop();
            $entity->setShop($shop);
        }
    }
}
