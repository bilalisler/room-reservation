<?php

namespace App\Controller\Api\v1;

use App\Controller\BaseController;
use App\Elasticsearch\RoomElasticService;
use App\Entity\Reservation;
use App\Exception\FormErrorException;
use App\Form\ReservationCreateType;
use App\Message\CreateReservationMessage;
use App\Message\CreateRoomMessage;
use App\Service\ReservationService;
use App\Service\RoomService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/room')]
class RoomController extends BaseController
{
    public function __construct(private RoomService $roomService, private RoomElasticService $elasticService)
    {
    }

    #[Route('/list', name: 'list_rooms', methods: ['GET'])]
    public function listRooms(): JsonResponse
    {
        $rooms = $this->elasticService->allRooms();
        return $this->success($rooms, 'Success', 200, [], ['groups' => ['list']]);
    }

    #[Route('/create', name: 'create_room', methods: ['POST'])]
    public function createRoom(Request $request, MessageBusInterface $messageBus): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $room = $this->roomService->createRoom($data);

        $messageBus->dispatch(new CreateRoomMessage($room));
        return $this->success([], 'Success', 200, [], ['groups' => ['list']]);
    }

    #[Route('/delete', name: 'delete_room', methods: ['DELETE'])]
    public function deleteRoom(): JsonResponse
    {
        return $this->success([], 'Success', 200, [], ['groups' => ['list']]);
    }
}
