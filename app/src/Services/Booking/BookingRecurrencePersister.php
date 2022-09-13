<?php


namespace App\Services\Booking;

use App\Entity\Booking;
use DateInterval;
use DatePeriod;
use Doctrine\ORM\EntityManagerInterface;

class BookingRecurrencePersister
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    )
    {
    }

    public function persistBookingDates(Booking $booking, DateInterval $bookingDuration): void
    {
        switch (true) {
            case $booking->getRecurrenceType() === 1 :
                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($booking->getBeginDate(), $interval, $booking->getRecurrenceDate());

                $this->persist($booking, $period, $bookingDuration);

                break;
            case $booking->getRecurrenceType() == 2 :
                $interval = DateInterval::createFromDateString('1 week');
                $period = new DatePeriod($booking->getBeginDate(), $interval, $booking->getRecurrenceDate());

                $this->persist($booking, $period, $bookingDuration);

                break;
            case $booking->getRecurrenceType() == 3 :
                $interval = DateInterval::createFromDateString('1 month');
                $period = new DatePeriod($booking->getBeginDate(), $interval, $booking->getRecurrenceDate());

                $this->persist($booking, $period, $bookingDuration);

                break;
            default :
                $this->em->persist($booking);
                $this->em->flush();
                break;
        }
    }
    private function persist(Booking $booking, DatePeriod $period, DateInterval $bookingDuration): void
    {
        $title = $booking->getTitle();
        $endRecurrence = $booking->getRecurrenceDate();
        foreach ($period as $dt) {
            $date = $dt;
            $booking = new Booking();
            $booking->setBeginDate($date)
                ->setTitle($title)
                ->setRecurrenceDate($endRecurrence);


            $this->em->persist($booking);
            $this->em->flush();

            $booking->setEndDate($dt->add($bookingDuration));
            $this->em->persist($booking);
        }
        $this->em->flush();
    }

}