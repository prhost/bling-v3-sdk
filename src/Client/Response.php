<?php

namespace Bling\Client;


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
            $response = json_decode($this->contents);
        } else {
            $response = [$this->contents];
        }

        return $response;
    }
}
