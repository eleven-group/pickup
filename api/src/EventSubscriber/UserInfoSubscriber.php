<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserInfoSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['resolveMe', EventPriorities::PRE_READ],
        ];
    }

    public function resolveMe(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ('api_users_get_item' !== $request->attributes->get('_route')) {
            return;
        }

        if ('me' !== $request->attributes->get('id')) {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if (!$user instanceof User) {
            return;
        }

        $request->attributes->set('id', $user->getId());
    }
}
