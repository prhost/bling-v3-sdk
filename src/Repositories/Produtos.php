<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Classes\Collection;

class Produtos extends BaseRepository
{
    public function get(int $pagina = 1, int $limite = 100, array $filtros = []): Collection
    {
        $response = $this->request('GET', 'produtos',
            [
                'query' => [
                        'pagina' => $pagina,
                        'limite' => $limite,
                    ] + $filtros
            ]
        )->getResponse();

        return new Collection($response->data ?? []);
    }

    public function getById(int $id): ?\stdClass
    {
        $response = $this->request('GET', 'produtos/' . $id)->getResponse();

        return $response->data ?? null;
    }

    public function create(array $data)
    {
        $response = $this->request('POST', 'produtos', [
            'json' => $data
        ])->getResponse();

        return $response->data ?? null;
    }

    public function update(int $id, array $data)
    {
        $response = $this->request('PUT', 'produtos/' . $id, [
            'json' => $data
        ])->getResponse();

        return $response->data ?? null;
    }

    public function deleteById(int $id): void
    {
        $this->request('DELETE', 'produtos/' . $id);
    }

    public function delete(array $ids): void
    {
        $this->request('DELETE', 'produtos', [
            'query' => [
                'idsProdutos' => $ids
            ]
        ]);
    }

    public function updateSituation(int $id, string $situacao): void
    {
        $this->request('PATCH', 'produtos/' . $id . '/situacoes', [
            'json' => [
                'situacao' => $situacao
            ]
        ]);
    }
}
