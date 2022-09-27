<?php
namespace App\MessageHandler;

use App\Elasticsearch\ReservationElasticService;
use App\Entity\Reservation;
use App\Message\CreateReservationMessage;
use App\Repository\ReservationRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateReservationMessageHandler implements MessageHandlerInterface
{
    public function __construct(private ReservationElasticService $elasticService,private SerializerInterface $serializer,private ReservationRepository $repository){}

    public function __invoke(CreateReservationMessage $message)
    {
        /**
         * @var $reservation Reservation
         */
        $reservation = $this->repository->find($message->getReservationId());

        $data = $this->serializer->serialize($reservation,'json');
        $data = json_decode($data,true);

        $this->elasticService->save($data);
    }
}
