<?php

namespace App\Controller\Api\v1;

use App\Controller\BaseController;
use App\Service\SearchService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search')]
class SearchController extends BaseController
{
    public function __construct(private SearchService $searchService)
    {
    }

    #[Route('/room', name: 'search_room')]
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $result = $this->searchService->searchRoom($data);

        return $this->success($result);
    }
}
