<?php
namespace App\MessageHandler;

use App\Elasticsearch\ReservationElasticService;
use App\Message\CreateReservationMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateReservationMessageHandler implements MessageHandlerInterface
{
    public function __construct(private ReservationElasticService $elasticService,private SerializerInterface $serializer){}

    public function __invoke(CreateReservationMessage $message)
    {
        $data = $this->serializer->serialize($message->getReservation(),'json');
        $data = json_decode($data,true);

        $this->elasticService->save($data);
    }
}
