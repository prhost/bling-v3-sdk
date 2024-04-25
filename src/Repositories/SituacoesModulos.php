<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Classes\Collection;
use Prhost\Bling\Repositories\Traits\CrudRepository;

class SituacoesModulos extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'situacoes/modulos';

    public function getByIdFromAction(int $id): Collection
    {
        $uri = rtrim($this->uri, '/') . '/' . $id . '/acoes';
        $response = $this->request('GET', $uri)->getResponse();

        return new Collection($response->data ?? []);
    }

}