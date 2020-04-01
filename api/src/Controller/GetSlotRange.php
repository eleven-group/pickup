<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Booking;
use App\Entity\Shop;
use App\Repository\BookingRepository;
use App\Repository\ShopRepository;

class GetSlotRange
{

    private $br;
    private $sr;

    public function __construct(BookingRepository $br, ShopRepository $sr)
    {
        $this->br = $br;
        $this->sr = $sr;
    }


    public function __invoke(Request $request,int $id)
    {
        $page = $request->query->get('page');

        if($page === null)
            $page = 1;


        // todo : generate slots
        // update booking with booking Item

        $shop = $this->sr->findOneById($id);

        $slots = $this->generateSlots($shop->getSlotRange(), $shop->getOpeningHours());

        $bookings = $this->br->getSlots($id, $page);


        return 'hello world';
    }

    private function generateSlots($range, $hours){
        return 'calculus';
    }
}
