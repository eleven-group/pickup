<?php

namespace App\EventListener;

use App\Entity\Shop;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ShopImageListener
{

    // the listener methods receive an argument which gives you access to
    // both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Shop ) {
            return;
        }

        $type = $entity->getCategory();

        $cover = $this->getCover($type);

        $entity->setImageUrl($cover);
    }

    private function getCover($type) {
        $covers = [
            "pizza" => [
                "1574071318508-1cdbab80d002",
                "1513104890138-7c749659a591"
            ],
            "burger" => [
                "1568901346375-23c9450c58cd",
                "1551782450-a2132b4ba21d"
            ],
            "butcher" => [
                "1560166444-441876015a70",
                "1529241160658-a8a2a0d86620"
            ],
            "producer" => [
                "1498837167922-ddd27525d352",
                "1471193945509-9ad0617afabf"
            ],
            "pastry" => [
                "1523198205441-99fac53d157f",
                "1483695028939-5bb13f8648b0"
            ],
            "other" => [
                "1539755530862-00f623c00f52",
                "1533900298318-6b8da08a523e"
            ],
            "baker" => [
                "1515823808611-65fd8e56c71a",
                "1477763858572-cda7deaa9bc5"
            ]
        ];
        return "https://images.unsplash.com/photo-".$covers[$type][rand(1,2)-1]."?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80";
    }
}
