<?php

namespace Prhost\Bling\Client;


class Response extends \GuzzleHttp\Psr7\Response
{
    protected $contents;

    /**
     * @return array|mixed|\StdClass
     */
    public function getResponse()
    {
        if (null === $this->contents) {
            $this->contents = $this->getBody()->getContents();
        }

        if ($this->contents) {
            // JSON_BIGINT_AS_STRING: Converte integers grandes (> PHP_INT_MAX) para string
            // Evita overflow em sistemas 32-bit onde PHP_INT_MAX = 2^31 - 1 (2.147.483.647)
            $response = json_decode($this->contents, false, 512, JSON_BIGINT_AS_STRING);
        } else {
            $response = [$this->contents];
        }

        return $response;
    }
}
