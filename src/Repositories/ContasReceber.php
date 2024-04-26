<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class ContasReceber extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'contas/receber';

    protected $queryParam = 'idContaReceber';

}