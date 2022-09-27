<?php

namespace App\Message;

class CreateReservationMessage
{
    public function __construct(private int $reservationId){}

    /**
     * @return int
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }
}
