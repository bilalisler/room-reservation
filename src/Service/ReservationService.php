<?php

namespace App\Service;

use App\Entity\Reservation;
use App\Exception\FormErrorException;
use App\Form\ReservationCreateType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class ReservationService
{
    private ReservationRepository $reservationRepository;

    public function __construct(private EntityManagerInterface $entityManager, private FormFactoryInterface $formFactory)
    {
        $this->reservationRepository = $entityManager->getRepository(Reservation::class);
    }

    public function removeReservation(Reservation $reservation)
    {
        $this->reservationRepository->remove($reservation, true);
    }

    public function getReservation($id)
    {
        return $this->reservationRepository->find($id);
    }

    /**
     * @param array $data
     * @return Reservation
     * @throws FormErrorException
     */
    public function createReservation(array $data): Reservation
    {
        // deserialize and validate the request data
        $reservation = new Reservation();
        $form = $this->formFactory->create(ReservationCreateType::class, $reservation);
        $form->submit($data);

        if(!$form->isValid()){
            throw new FormErrorException($form->getErrors());
        }

        $this->reservationRepository->save($reservation, true);

        return $reservation;
    }
}
