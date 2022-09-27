<?php

namespace App\Command;

use App\Elasticsearch\ReservationElasticService;
use App\Elasticsearch\RoomElasticService;
use App\Entity\Reservation;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'TransferDataFromMysqlToElastic',
    description: 'This command will run when first run the project for feeding migrations to elastic',
)]
class TransferDataFromMysqlToElasticCommand extends Command
{
    private $roomElasticService;
    private $reservationElasticService;
    private $serializer;
    private $em;

    public function __construct(EntityManagerInterface $entityManager, RoomElasticService $roomElasticService, ReservationElasticService $reservationElasticService, SerializerInterface $serializer)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
        $this->roomElasticService = $roomElasticService;
        $this->reservationElasticService = $reservationElasticService;

        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rooms = $this->em->getRepository(Room::class)->findAll();
        foreach ($rooms as $room) {
            $roomData = $this->serializer->serialize($room, 'json', ['groups' => ['list']]);
            $roomData = json_decode($roomData, true);

            $this->roomElasticService->createIndexAndMapping();
            $this->roomElasticService->save($roomData);
        }

        $reservations = $this->em->getRepository(Reservation::class)->findAll();
        foreach ($reservations as $reservation) {
            $reservationData = $this->serializer->serialize($reservation, 'json', ['groups' => ['list']]);
            $reservationData = json_decode($reservationData, true);

            $this->reservationElasticService->createIndexAndMapping();
            $this->reservationElasticService->save($reservationData);
        }

        $io = new SymfonyStyle($input, $output);
        $io->success('All data was migrated to Elastic Server');

        return Command::SUCCESS;
    }
}
