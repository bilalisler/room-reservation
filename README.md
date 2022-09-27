# Room Reservation REST Api Doc
***
### to run the REST Api follow the following steps;
1. run project: `$ docker-compose up -d`
3. run schema update: `$ docker exec docker_service_php php bin/console doctrine:schema:update --force`
3. run migrations: `$ docker exec docker_service_php php bin/console doctrine:migrations:migrate`
3. run migrations: `$ docker exec docker_service_php php bin/console TransferDataFromMysqlToElastic`
3. run migrations: `$ docker exec docker_service_php php bin/console messenger:consume -vv`
4. run project `https://localhost:8088`

***

## System Design Architecture
![Alt text](./system_architecture.png?raw=true)

***

## Database Diagram
![Alt text](./database_diagram.png?raw=true)
database diagram:
 ``https://drawsql.app/teams/selfteam-1/diagrams/reservation-database``
***

## Endpoints
#### list reservations

```
curl --location --request GET 'https://localhost:8088/api/v1/reservation/list'
```

#### create reservation

```
curl --location --insecure --request POST 'https://localhost:8088/api/v1/reservation/create' \
--header 'Content-Type: application/json' \
--data-raw '{
    "payment": {
        "cardNumber": "4716841611983226",
        "cardOwner": "test test",
        "cardCvc": 621,
        "cardExpiry": "07/28"
    },
    "user": 1,
    "room": 1,
    "startDate": "2022-09-26",
    "endDate": "2022-09-29",
    "guestCount": 2
}'
```

***

### Tools
- Project: https://localhost:8088
- Kibana: http://localhost:5601
- Elasticsearch: http://localhost:9200

### Packages
- elastic search: https://github.com/elastic/elasticsearch-php/tree/7.0
- messenger bus: https://symfony.com/doc/current/components/messenger.html
