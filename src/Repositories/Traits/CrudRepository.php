<?php

namespace Prhost\Bling\Repositories\Traits;

use Prhost\Bling\Classes\Collection;

trait CrudRepository
{
    public function get(int $pagina = 1, int $limite = 100, array $filtros = []): Collection
    {
        $response = $this->request(
            'GET',
            $this->uri,
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
        $response = $this->request('GET', rtrim($this->uri, '/') . '/' . $id)->getResponse();

        debug($response);

        return $response->data ?? null;
    }

    public function create(array $data)
    {
        $response = $this->request('POST', $this->uri, [
            'json' => $data
        ])->getResponse();

        return $response->data ?? null;
    }

    public function update(int $id, array $data)
    {
        $response = $this->request('PUT', rtrim($this->uri, '/') . '/' . $id, [
            'json' => $data
        ])->getResponse();

        return $response->data ?? null;
    }

    public function deleteById(int $id): void
    {
        $this->request('DELETE', rtrim($this->uri, '/') . '/' . $id);
    }

    public function delete(array $ids): void
    {
        $this->request('DELETE', $this->uri, [
            'query' => [
                $this->queryParam => $ids
            ]
        ]);
    }
}