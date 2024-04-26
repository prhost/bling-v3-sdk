<?php

namespace Prhost\Bling;

use Prhost\Bling\Endpoints\EndpointBase;

class Bling extends EndpointBase
{
    public function __construct(string $clientId, string $secretKey)
    {
        $this->clientId = $clientId;
        $this->secretKey = $secretKey;
    }

    public function requestAuthorization($state = null, $permission = null, $redirect = true)
    {
        $this->state = $state ?: md5(random_int(100000, 999999));

        $query = "&state=" . $this->state;

        if ($this->urlCallback)
            $query .= "&redirect_uri=" . $this->urlCallback;

        $urlRedirect = $this->getBaseUri("oauth/authorize?client_id={$this->clientId}&response_type=code{$query}&scope={$permission}");

        if ($redirect == true) {
            header("Location: " . $urlRedirect);
        } else {
            return $urlRedirect;
        }
    }

    /**
     * Método responsável por solicitar um token de acesso na plataforma do bling.
     * Esse método é utilizado quando nunca foi solicitado um token antes.
     *
     * @param $code // Codigo retornado pela plaforma quando solicita a permissão
     * @return \stdClass
     */
    public function requestToken(string $code): \stdClass
    {
        return $this->requestoOrRefreshToken($code);
    }

    /**
     * Método responsável por solicitar a renovação de um token de acesso já existente
     * na plataforma do Bling.
     *
     * @param $refreshToken // Token de atualização do token de solicitação
     * @return array
     */
    public function refreshToken($refreshToken)
    {
        return $this->requestoOrRefreshToken(null, $refreshToken);
    }

    /**
     * Método interno responsável por realizar a configuração e a requisição
     * tanto para gerar um token novo como para renovar um token já existente.
     *
     * @param null $code
     * @param null $refreshToken
     * @return \stdClass
     */
    protected function requestoOrRefreshToken($code = null, $refreshToken = null): \stdClass
    {
        $payload = [];

        if ($refreshToken) {
            $payload["grant_type"] = "refresh_token";
            $payload["refresh_token"] = $refreshToken;
        } else {
            $payload["grant_type"] = "authorization_code";
            $payload["code"] = $code;
        }

        $this->getApiClient();

        $response = $this->request("POST", "oauth/token", ['form_params' => $payload])->getResponse();

        return $response;
    }

    public function produtos(): Repositories\Produtos
    {
        return new Repositories\Produtos($this->getApiClient());
    }

    public function pedidosVendas(): Repositories\PedidosVendas
    {
        return new Repositories\PedidosVendas($this->getApiClient());
    }

    public function nfce(): Repositories\Nfce
    {
        return new Repositories\Nfce($this->getApiClient());
    }

    public function estoques(): Repositories\Estoques
    {
        return new Repositories\Estoques($this->getApiClient());
    }

    public function produtosCategorias(): Repositories\ProdutosCategorias
    {
        return new Repositories\ProdutosCategorias($this->getApiClient());
    }

    public function contatos(): Repositories\Contatos
    {
        return new Repositories\Contatos($this->getApiClient());
    }

    public function depositos(): Repositories\Depositos
    {
        return new Repositories\Depositos($this->getApiClient());
    }

    public function situacoes(): Repositories\Situacoes
    {
        return new Repositories\Situacoes($this->getApiClient());
    }

    public function contasReceber(): Repositories\ContasReceber
    {
        return new Repositories\ContasReceber($this->getApiClient());
    }

    public function situacoesModulos(): Repositories\SituacoesModulos
    {
        return new Repositories\SituacoesModulos($this->getApiClient());
    }
}