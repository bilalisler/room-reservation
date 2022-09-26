<?php
namespace App\Service;

use App\Elasticsearch\RoomElasticService;

class SearchService
{
    public function __construct(private RoomElasticService $elasticService){}

    public function searchRoom(){

    }
}
