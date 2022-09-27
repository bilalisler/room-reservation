<?php
namespace App\Message;

use App\Entity\Room;

class CreateRoomMessage
{
    public function __construct(private Room $room){}

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }
}
