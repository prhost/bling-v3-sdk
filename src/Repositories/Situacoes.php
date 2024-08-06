<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class Situacoes extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'situacoes';

    public function default(): array
    {
        return [
            6  => 'Em aberto',
            9  => 'Atendido',
            12 => 'Cancelado',
            15 => 'Em andamento',
            18 => 'Venda Agenciada',
            21 => 'Em digitação',
            24 => 'Verificado',
        ];
    }
}
