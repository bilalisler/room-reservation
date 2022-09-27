<?php
namespace App\Service;

use App\Elasticsearch\RoomElasticService;
use App\Exception\FormErrorException;
use App\Form\SearchRoomType;
use App\Request\SearchRoomRequest;
use Symfony\Component\Form\FormFactoryInterface;

class SearchService
{
    public function __construct(private RoomElasticService $elasticService, private FormFactoryInterface $formFactory)
    {
    }

    public function searchRoom(array $data)
    {
        $searchRequest = new SearchRoomRequest();
        $form = $this->formFactory->create(SearchRoomType::class, $searchRequest);
        $form->submit($data);

        if ($form->isValid() === false) {
            throw new FormErrorException($form->getErrors());
        }

        return $this->elasticService->searchRoomRequest($searchRequest);
    }
}
