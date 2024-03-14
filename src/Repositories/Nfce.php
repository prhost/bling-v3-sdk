<?php

namespace Prhost\Bling\Repositories;

class Nfce extends BaseRepository
{
    protected $uri = 'nfce';

    public function create(array $data)
    {
        $response = $this->request('POST', $this->uri, [
            'json' => $data
        ])->getResponse();

        return $response->data ?? null;
    }

    public function enviar($idNotaFiscal)
    {
        $response = $this->request('POST', $this->uri . '/' . $idNotaFiscal . '/enviar')->getResponse();

        return $response->data ?? null;
    }

    public function getById(int $id): ?\stdClass
    {
        $response = $this->request('GET', rtrim($this->uri, '/') . '/' . $id)->getResponse();

        return $response->data ?? null;
    }
}
