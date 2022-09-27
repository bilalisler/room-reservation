<?php
namespace App\Message;

class CreateRoomMessage
{
    public function __construct(private int $roomId){}

    /**
     * @return int
     */
    public function getRoomId(): int
    {
        return $this->roomId;
    }
}
