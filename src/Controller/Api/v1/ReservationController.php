<?php

namespace App\Controller\Api\v1;

use App\Controller\BaseController;
use App\Elasticsearch\ReservationElasticService;
use App\Message\CreateReservationMessage;
use App\Service\ReservationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/reservation')]
class ReservationController extends BaseController
{
    public function __construct(private ReservationService $reservationService, private ReservationElasticService $elasticService)
    {
    }

    #[Route('/list', name: 'list_reservations', methods: ['GET'])]
    public function listReservations(): JsonResponse
    {
        $reservations = $this->elasticService->allReservations();
        return $this->success($reservations, 'Success', 200, [], ['groups' => ['list']]);
    }

    #[Route('/create', name: 'create_reservation', methods: ['POST'])]
    public function createReservation(Request $request, MessageBusInterface $messageBus): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $reservation = $this->reservationService->createReservation($data);

        $messageBus->dispatch(new CreateReservationMessage($reservation));

        return $this->success([], 'reservation was created', 200);
    }

    #[Route('/delete', name: 'delete_reservation', methods: ['DELETE'])]
    public function deleteReservation(): JsonResponse
    {
        return $this->success([], 'Success', 200, [], ['groups' => ['list']]);
    }
}
