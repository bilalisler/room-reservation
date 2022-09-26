<?php
namespace App\Elasticsearch;

use Elasticsearch\Client;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractElasticService
{
    protected abstract function indexName(): string; // index name

    public function __construct(public Client $client){}

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
}
