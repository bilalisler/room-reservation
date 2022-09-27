<?php

namespace App\Service;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Exception\FormErrorException;
use App\Form\ReservationCreateType;
use App\Form\RoomCreateType;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class RoomService
{
    private RoomRepository $roomRepository;

    public function __construct(private EntityManagerInterface $entityManager, private FormFactoryInterface $formFactory)
    {
        $this->roomRepository = $entityManager->getRepository(Room::class);
    }

    public function removeRoom(Room $room)
    {
        $this->roomRepository->remove($room, true);
    }

    public function getRoom($id)
    {
        return $this->roomRepository->find($id);
    }

    /**
     * @param array $data
     * @return Reservation
     * @throws FormErrorException
     */
    public function createRoom(array $data): Room
    {
        // deserialize and validate the request data
        $room = new Room();
        $form = $this->formFactory->create(RoomCreateType::class, $room);
        $form->submit($data);

        if (!$form->isValid()) {
            throw new FormErrorException($form->getErrors());
        }

        $this->roomRepository->save($room, true);

        return $room;
    }
}
