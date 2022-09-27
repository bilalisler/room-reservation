<?php

namespace App\Message;

use App\Entity\Reservation;

class CreateReservationMessage
{
    public function __construct(private Reservation $reservation){}

    /**
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }
}
