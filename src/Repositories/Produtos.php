<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Classes\Collection;

class Produtos extends BaseRepository
{
    protected $uri = 'produtos';

    protected $queryParam = 'idsProdutos';

    public function updateSituation(int $id, string $situacao): void
    {
        $this->request('PATCH', $this->uri . '/' . $id . '/situacoes', [
            'json' => [
                'situacao' => $situacao
            ]
        ]);
    }
}
