<?php

namespace App\EventListener;

use App\Entity\Booking;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Service\Mailer;

class ResourceUpdateEventListener
{

    private $mailer;
    private $baseUrl;

    public function __construct(string $baseUrl, Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->baseUrl = $baseUrl;
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Booking) {
            return;
        }
        if ('cli' != php_sapi_name())
        {

            switch ($entity->getStatus()) {
                case 'accepted':
                    $this->confirmBookingForUser($entity);
                    $this->NewBookingForProd($entity);
                    break;
                case 'canceled':
                    $this->cancelBookingByProdForUser($entity);
                    break;
                case 'canceled_by_user':
                    $this->cancelBookingByUserForUser($entity);
                    $this->cancelBookingByUserForProd($entity);
                    break;
                default:
                    break;
            }

            return;
        }
    }

    private function cancelBookingByProdForUser($booking)
    {
        $templateId = 'user_order_canceled_by_prod';
        $params = [
            'orderId' => $booking->getId()
        ];
        $this->mailer->sendMail($booking->getEmail(), $templateId, $params);
    }

    private function cancelBookingByUserForUser($booking)
    {
        $templateId = 'user_order_canceled_by_user';
        $params = [
            'orderId' => $booking->getId(),
            'shopName' => $booking->getShop()->getName(),
        ];
        $this->mailer->sendMail($booking->getEmail(), $templateId, $params);
    }

    private function cancelBookingByUserForProd($booking)
    {
        $templateId = 'prod_order_canceled_by_user';
        $params = [
            'orderId' => $booking->getId(),
            'adminUrl' => 'https://admin.'.$this->baseUrl,
        ];
        $email = $booking->getShop()->getOwner()->getEmail();
        $this->mailer->sendMail($email, $templateId, $params);
    }

    private function confirmBookingForUser($booking)
    {
        $templateId = 'user_order_confirmation';
        $params = [
            'shippingDate' => $booking->getDateFormatted(),
            'price' => $booking->getTotalFormatted(),
            'shopName' => $booking->getShop()->getName(),
            'shopAddress' => $booking->getShop()->getAddress(),
            'orderId' => $booking->getId(),
            'cancelOrder' => 'https://'.$this->baseUrl.'/cancel-booking?token='.$booking->getToken(),
        ];
        $this->mailer->sendMail($booking->getEmail(), $templateId, $params);
    }

    private function NewBookingForProd($booking)
    {
        $templateId = 'prod_order_new';
        $params = [
            'shippingDate' => $booking->getDateFormatted(),
            'price' => $booking->getTotalFormatted(),
            'clientName' => $booking->getFirstname().' '.$booking->getFirstname(),
            'clientEmail' => $booking->getEmail(),
            'clientPhone' => $booking->getPhonenumber(),
            'orderId' => $booking->getId(),
            'commandLink' => 'https://admin.'.$this->baseUrl.'/#/bookings/2'.$booking->getId().'/show',
        ];
        $email = $booking->getShop()->getOwner()->getEmail();
        $this->mailer->sendMail($email, $templateId, $params);
    }
}
