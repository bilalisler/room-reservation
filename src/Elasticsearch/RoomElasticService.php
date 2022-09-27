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
        $guestCount = $request->getGuestCount();
        $country = $request->getCountry();
        $city = $request->getCity();

        $minStayCount = $request->getStartDate()->diff($request->getEndDate())->days;

        $query = json_decode('{"query":{"bool":{"must":[{"term":{"country":{"value":"'.$country.'"}}},{"term":{"city":{"value":"'.$city.'"}}},{"range":{"totalCapacity":{"gte":'.$guestCount.'}}},{"range":{"minStayDayCount":{"gte":'.$minStayCount.'}}}]}}}',true);
        $result = $this->search($query);

        return $result['hits']['hits'];
    }
}
