<?php

namespace Prhost\Bling\Classes;


use Mitryusweb\Api\Mitryusweb;
use Mitryusweb\Client\ApiClient;
use Mitryusweb\Client\Response;

abstract class EndpointBase
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    public function __construct($apiClient = null)
    {
        if (null === $apiClient) {
            if (Mitryusweb::$apiClient === null) {
                Mitryusweb::init();
            }
            $this->apiClient = Mitryusweb::$apiClient;
        } else {
            $this->apiClient = $apiClient;
        }
    }

    /**
     * @return ApiClient
     */
    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
    }

    /**
     * @param ApiClient $apiClient
     */
    public function setApiClient(ApiClient $apiClient): void
    {
        $this->apiClient = $apiClient;
    }

    protected function request(string $method, string $uri, array $options = []): Response
    {
        return $this->getApiClient()->request($method, $uri, $options);
    }
}
