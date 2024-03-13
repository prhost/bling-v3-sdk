<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class Estoques extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'estoques';

    protected $queryParam = 'idsProdutos';

}
