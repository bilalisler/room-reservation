<?php
namespace App\MessageHandler;

use App\Elasticsearch\RoomElasticService;
use App\Message\CreateRoomMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateRoomMessageHandler implements MessageHandlerInterface
{
    public function __construct(private RoomElasticService $elasticService,private SerializerInterface $serializer){}

    public function __invoke(CreateRoomMessage $message)
    {
        $data = $this->serializer->serialize($message->getRoom(),'json');
        $data = json_decode($data,true);

        $this->elasticService->save($data);
    }
}
