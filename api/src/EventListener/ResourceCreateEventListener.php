<?php

namespace App\EventListener;

use App\Entity\User;
use App\Entity\Booking;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Service\Mailer;

class ResourceCreateEventListener
{

    private $mailer;
    private $baseUrl;

    public function __construct(string $baseUrl, Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->baseUrl = $baseUrl;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if (!$entity instanceof User && !$entity instanceof Booking) {
            return;
        }

        if ('cli' != php_sapi_name())
        {

            if($entity instanceof User){
                $this->createUserEmail($entity);
                return;
            }

            $this->createBookingEmail($entity);
            return;
        }

    }

    private function createUserEmail($user) {

        $templateId = 'prod_register_confirmation';

        $params = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'adminUrl' => 'https://admin.'.$this->baseUrl,
        ];

        $this->mailer->sendMail($user->getEmail(), $templateId, $params);
    }

    private function createBookingEmail($booking) {

        $templateId = 'user_order_validation';

        $params = [
            'shippingDate' => $booking->getDateFormatted(),
            'price' => $booking->getTotalFormatted(),
            'shopName' => $booking->getShop()->getName(),
            'shopAddress' => $booking->getShop()->getAddress(),
            'commandValidationLink' => 'https://'.$this->baseUrl.'/confirmation-new-booking?token='.$booking->getToken(),
            'orderId' => $booking->getId(),
        ];

        $this->mailer->sendMail($booking->getEmail(), $templateId, $params);
    }
}
