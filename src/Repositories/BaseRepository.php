<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Client\ApiClient;

class BaseRepository
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    public function __construct(ApiClient $client)
    {
        $this->apiClient = $client;
    }

    protected function request(string $method, string $uri, array $options = [])
    {
        return $this->apiClient->request($method, $uri, $options);
    }
}
