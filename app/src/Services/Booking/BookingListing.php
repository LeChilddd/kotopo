<?php

namespace App\Services\Booking;

use App\Entity\Booking;
use App\Exception\BadDataException;
use App\Helper\ApiMessages;
use App\Repository\BookingRepository;

class BookingListing
{
    private BookingRepository $repository;

    public function __construct(
        BookingRepository $repository
    )
    {
        $this->repository = $repository;

    }
    public function todayEvent(): array
    {
        $date = new \DateTime('now');
        $endDate = new \DateTime('today 24:00');
        return $this->repository->findBookingForSpecificDate($date->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s'));
    }
    public function tomorrowEvent(): array
    {
        $date = new \DateTime('tomorrow');
        $endDate = new \DateTime('tomorrow 24:00');
        return $this->repository->findBookingForSpecificDate($date->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s'));
    }
}