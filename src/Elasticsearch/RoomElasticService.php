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
        $startDate = $request->getStartDate()->format('Y-m-d');
        $endDate = $request->getEndDate()->format('Y-m-d');
        $guestCount = $request->getGuestCount();
        $country = $request->getCountry();
        $city = $request->getCity();

        $query = json_decode('{"query":{"bool":{"must":[{"range":{"order_date":{"gte":"'.$startDate.'","lte":"'.$endDate.'"}}},{"term":{"guestCount":{"value":'.$guestCount.'}}},{"term":{"country":{"value":"'.$country.'"}}},{"term":{"city":{"value":"'.$city.'"}}}]}}}',true);

        $result = $this->search($query);

        return $result['hits']['hits'];
    }
}
