<?php

namespace Prhost\Bling\Endpoints;

use Prhost\Bling\Client\ApiClient;
use Prhost\Bling\Client\Response;

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
        // Reutilizar ApiClient existente se já foi criado e configurações não mudaram
        if ($this->apiClient) {
            // Verificar se access_token mudou e precisa recriar o cliente
            if ($this->apiClient->getAccessToken() !== $this->accessToken) {
                // Token mudou, recriar cliente com novo token
                $this->apiClient = new ApiClient([
                    'client_id'   => $this->clientId,
                    'secret_key'  => $this->secretKey,
                    'access_token' => $this->accessToken,
                    'base_uri'    => $this->getBaseUri(),
                ]);
            }
            return $this->apiClient;
        }

        // Criar novo ApiClient na primeira vez
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
