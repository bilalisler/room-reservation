<?php
namespace App\Elasticsearch;

use Elasticsearch\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractElasticService
{
    protected abstract function indexName(): string; // index name

    public function __construct(public Client $client,private ParameterBagInterface $parameterBag){}

    public function search($query)
    {
        $resolver = new OptionsResolver();
        $resolver->setDefault('index', $this->indexName());
        $resolver->setRequired(['body']);
        $resolver->setAllowedTypes('body', ['array', 'object']);

        $params = $resolver->resolve([
            'body' => $query
        ]);

        return $this->client->search($params);
    }

    public function save(array $data, $id = '')
    {
        $resolver = new OptionsResolver();
        $resolver->setDefault('index', $this->indexName());
        $resolver->setRequired(['body', 'id']);
        $resolver->setAllowedTypes('body', ['array', 'object']);
        $resolver->setAllowedTypes('id', ['string', 'int']);

        $params = $resolver->resolve([
            'body' => $data,
            'id' => $id
        ]);

        return $this->client->index($params);
    }


    public function existsIndice()
    {
        $esUrl = rtrim($this->parameterBag->get('elasticsearch_url'),'/');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $esUrl .'/' . $this->indexName(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        if (!array_key_exists($this->indexName(), $response)) {
            return false;
        }
        return true;
    }

    public function createIndexAndMapping(): array
    {
        $existsIndice = $this->existsIndice();
        if ($existsIndice === true) {
            return [];
        }
        $esUrl = rtrim($this->parameterBag->get('elasticsearch_url'),'/');

        $properties = Yaml::parse(file_get_contents(__DIR__ . '/../../config/elastic_mapping/' . $this->indexName() . '.yaml'));

        if (!array_key_exists('properties', $properties)) {
            throw new \Exception(sprintf('%s, properties keyword is missing on mapping', $this->indexName()));
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $esUrl.'/'.$this->indexName(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode([
                "settings" => [
                    "number_of_shards" => 1,
                    "number_of_replicas" => 0
                ],
                "mappings" => [
                    "properties" => $properties['properties']
                ]
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response =  json_decode($response, true);

        if(isset($response['error'])){
            throw new \Exception(json_encode($response));
        }

        return $response;
    }
}
