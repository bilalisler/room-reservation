<?php

namespace App\Elasticsearch;

class ReservationElasticService extends AbstractElasticService
{
    protected function indexName(): string
    {
        return 'reservation_index';
    }

    public function allReservations(){
        $result = $this->search([]);

        return $result['hits']['hits'];
    }
}
