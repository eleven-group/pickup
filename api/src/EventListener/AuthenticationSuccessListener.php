<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener {

/**
 * @param AuthenticationSuccessEvent $event
 */
public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
{
    $data = $event->getData();
    $user = $event->getUser();
    if (!$user instanceof User) {
        return;
    }

    $role = $user->getRoles();

    $store = null;

    if(null !== $user->getShop()){
        $store = $user->getShop()->getId();
    }

    $data['data'] = [
        'role' => $role[0],
        'active' => $user->getIsActive(),
        'store' => $store,
    ];

    $event->setData($data);
}

}
