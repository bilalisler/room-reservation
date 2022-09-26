<?php

namespace App\Controller\Api\v1;

use App\Controller\BaseController;
use App\Entity\Reservation;
use App\Exception\FormErrorException;
use App\Form\ReservationCreateType;
use App\Service\ReservationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation')]
class ReservationController extends BaseController
{
    public function __construct(private ReservationService $reservationService){}

    #[Route('/list', name: 'list_reservations')]
    public function listReservations(): JsonResponse
    {
        $reservations = $this->reservationService->allReservations();
        return $this->success($reservations,'Success',200,[],['groups' => ['list']]);
    }

    #[Route('/create', name: 'create_reservation')]
    public function createReservation(Request $request): JsonResponse
    {
        $data =  json_decode($request->getContent(),true);

        $reservation = new Reservation();
         $form = $this->createForm(ReservationCreateType::class, $reservation);
        $form->submit($data);

        if(!$form->isValid()){
            throw new FormErrorException($form->getErrors());
        }

        // todo: calculate price and total then save reservation then dispatch an event

        return $this->success([],'reservation was created',200);
    }
}
