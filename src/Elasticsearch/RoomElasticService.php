<?php

namespace App\Elasticsearch;


use App\Request\SearchRoomRequest;

class RoomElasticService extends AbstractElasticService
{
    protected function indexName(): string
    {
        return 'room_index';
    }

    public function allRooms()
    {
        $result = $this->search([]);

        return $result['hits']['hits'];
    }

    public function searchRoomRequest(SearchRoomRequest $request)
    {
        $result = $this->search([]);

        return $result['hits']['hits'];
    }
}
