<?php

namespace App\Controller\Api\v1;

use App\Controller\BaseController;
use App\Elasticsearch\RoomElasticService;
use App\Exception\FormErrorException;
use App\Form\SearchRoomType;
use App\Request\SearchRoomRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search')]
class SearchController extends BaseController
{
    public function __construct(private RoomElasticService $elasticService){}

    #[Route('/room', name: 'search_room')]
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(),true);

        $searchRequest = new SearchRoomRequest();
        $form = $this->createForm(SearchRoomType::class,$searchRequest);
        $form->submit($data);

        if($form->isValid() === false){
            throw new FormErrorException($form->getErrors());
        }

        $result = $this->elasticService->searchRoomRequest($searchRequest);

        return $this->success($result);
    }
}
