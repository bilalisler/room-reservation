<?php

namespace App\Service;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    private ReservationRepository $reservationRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->reservationRepository = $entityManager->getRepository(Reservation::class);
    }

    public function allReservations()
    {
        return $this->reservationRepository->findAll();
    }

    public function getReservation($id)
    {
        return $this->reservationRepository->find($id);
    }

    public function createReservation(Reservation $reservation)
    {
        $this->reservationRepository->save($reservation, true);
    }
}
