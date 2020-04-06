<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Booking;
use App\Repository\BookingRepository;

class ConfirmBooking
{
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function __invoke(Request $request, EntityManagerInterface $entityManager): Booking
    {
        $token = $request->query->get('token');
        try {
            $booking = $this->bookingRepository->findOneBy(['token' => $token]);
            $booking->setStatus('accepted');
            $booking->generateToken();
            $entityManager->persist($booking);
            $entityManager->flush();

            return $booking;
        }
        catch(Exception $e) {
            throw new Exception($e, "The booking can't be found.");
        }
    }
}
