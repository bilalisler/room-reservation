<?php

namespace App\Service;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;

class RoomService
{
    private RoomRepository $roomRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->roomRepository = $entityManager->getRepository(Room::class);
    }

    public function allRooms()
    {
        return $this->roomRepository->findAll();
    }

    public function getRoom($id)
    {
        return $this->roomRepository->find($id);
    }
}
