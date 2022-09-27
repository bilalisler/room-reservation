<?php
namespace App\MessageHandler;

use App\Elasticsearch\RoomElasticService;
use App\Entity\Room;
use App\Message\CreateRoomMessage;
use App\Repository\RoomRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateRoomMessageHandler implements MessageHandlerInterface
{
    public function __construct(private RoomElasticService $elasticService, private SerializerInterface $serializer, private RoomRepository $repository)
    {
    }

    public function __invoke(CreateRoomMessage $message)
    {
        /**
         * @var $room Room
         */
        $room = $this->repository->find($message->getRoomId());

        $data = $this->serializer->serialize($room, 'json',['groups' => ['list']]);
        $data = json_decode($data, true);

        $this->elasticService->createIndexAndMapping();
        $this->elasticService->save($data);
    }
}
