<?php

namespace App\Controller\Api\v1;

use App\Controller\BaseController;
use App\Entity\Reservation;
use App\Exception\FormErrorException;
use App\Form\ReservationCreateType;
use App\Service\ReservationService;
use App\Service\RoomService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/room')]
class RoomController extends BaseController
{
    public function __construct(private RoomService $roomService){}

    #[Route('/list', name: 'list_rooms')]
    public function listRooms(): JsonResponse
    {
        $rooms = $this->roomService->allRooms();
        return $this->success($rooms,'Success',200,[],['groups' => ['list']]);
    }
}
