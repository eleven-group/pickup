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

        $shop = $this->sr->findOneById($id);

        $slots = $this->generateSlots(
            $shop->getSlotRange(),
            $shop->getOpeningHours()
        );

        $bookings = $this->br->getSlots($id, $page);

        $data = $this->compareSlots($slots, $bookings);

        return $data;
    }

    private function generateSlots($slotTime, $schedule) {

        $weekDates = $this->generateDates();

        $slots = [];

        foreach ($schedule as $day => $time) {
            $slots[$weekDates[$day]] = $this->createDayRange($time, $day, $slotTime);
        }

        return $slots;
    }

    private function compareSlots($slots, $bookings) {

        $bookingSlots = [];
        foreach ($bookings as $booking) {

            $fulldate = $booking->getDate()->format('Y-m-d H:i:s');
            $daydate = $booking->getDate()->format('Y-m-d');

            if(!isset($bookingSlots[$daydate])){
                $bookingSlots[$daydate][] = $fulldate;
            }else{
                $bookingSlots[$daydate][] = $fulldate;
            }
        }

        foreach ($slots as $key => $daySlot) {

            if(isset($bookingSlots[$key])){
                $output[$key] = array_values(array_diff($daySlot, $bookingSlots[$key]));
            } else{
                $output[$key] = $daySlot;
            }
        }

        return ['slots' => $output];

    }

    private function createDayRange($time, $day, $slotTime) {


        $dayRange = [];


        $dates = $this->generateDates();

        foreach ($time as $range) {

            $var = explode('-',$range);
            $start=date_create($dates[$day].' '.$var[0]);
            $end=date_create($dates[$day].' '.$var[1]);
            $diff=date_diff($end,$start);

            $dayRange[] = $this->getSlotsForRange($diff, $slotTime, $start);
        }

        if(isset($dayRange[1])){
            $dayRange = array_merge($dayRange[0], $dayRange[1]);
        }

        return $dayRange;

    }

    private function getSlotsForRange($diff, $range, $startTime) {

        $rangeInMinute = ($diff->h*60)+$diff->m;

        $nbSlots = intval($rangeInMinute)/intval($range);
        $nbSlots = intval(round($nbSlots, 0, PHP_ROUND_HALF_DOWN));

        $slotForRange = [];

        for ($i=0; $i < $nbSlots; $i++) {
            date_add($startTime, date_interval_create_from_date_string($range.' minutes'));
            array_push($slotForRange, $startTime->format('Y-m-d H:i:s'));
        }
        return $slotForRange;


    }

    private function generateDates() {

        $toDay = strtolower(date('l'));

        $daysOfWeek = ['monday','tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $index = array_search($toDay, $daysOfWeek);

        $start = array_splice($daysOfWeek, 0, $index);
        $daysOfWeekSorted = array_merge($daysOfWeek, $start);

        $output = [];


        for ($i=0; $i < 7; $i++) {
            $date = date('Y-m-d',$this->addDaysToNow($i));
            $output[$daysOfWeekSorted[$i]] = $date;
        }

        return $output;
    }

    private function addDaysToNow($nbDays) {
        return mktime(0, 0, 0, date("m")  , date("d")+$nbDays, date("Y"));
    }

}
