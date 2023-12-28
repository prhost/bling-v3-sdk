<?php

namespace Bling\Endpoints;

use Bling\Client\ApiClient;
use Bling\Client\Response;

abstract class EndpointBase
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    protected $clientId;

    protected $secretKey;

    protected $accessToken;

    protected $urlCallback;

    protected $state;

    protected $urlApi = 'https://www.bling.com.br/Api/v3';

    protected function getApiClient()
    {
        $this->apiClient = new ApiClient([
            'client_id'   => $this->clientId,
            'secret_key'  => $this->secretKey,
            'access_token' => $this->accessToken,
            'base_uri'    => $this->getBaseUri(),
        ]);

        return $this->apiClient;
    }

    public function getBaseUri($path = null)
    {
        if ($path === null) {
            return rtrim($this->urlApi, '/') . '/';
        }

        return rtrim($this->urlApi, '/') . '/' . ltrim($path, '/') . '/';
    }

    /**
     * @param ApiClient $apiClient
     */
    public function setApiClient(ApiClient $apiClient): void
    {
        $this->apiClient = $apiClient;
    }

    public function request(string $method, string $uri, array $options = []): Response
    {
        return $this->getApiClient()->request($method, $uri, $options);
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    public function setCallbackURL($url)
    {
        // Salva a informação na constante
        $this->urlCallback = $url;
        return $this;
    }

    public function setAccessToken($token)
    {
        // Salva o Access Token
        $this->accessToken = $token;
        return $this;
    }
}
