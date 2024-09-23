<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class Estoques extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'estoques';

    protected $queryParam = 'idsProdutos';

    public function saldos(array $produtos): array
    {
        $response = $this->request('GET', rtrim($this->uri, '/') . '/saldos', [
            'query' => [
                'idsProdutos' => $produtos
            ]
        ])->getResponse();

        return $response->estoques ?? $response->data ?? [];
    }

}
