<?php

namespace App\Service\Booking;

class BookingDto
{
    const UPDATE_SUCCESS = "L'événement a bien été mis à jour";

    public function __construct(
        private \DateTime  $beginAt,
        private ?\DateTime  $endAt = null,
    )
    {
    }

    public function getBeginAt(): \DateTime
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTime  $beginAt): BookingDto
    {
        $this->beginAt = $beginAt;
        return $this;
    }

    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTime $endAt): BookingDto
    {
        $this->endAt = $endAt;
        return $this;
    }
}
