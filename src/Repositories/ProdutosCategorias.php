<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Classes\Collection;
use Prhost\Bling\Repositories\Traits\CrudRepository;

class ProdutosCategorias extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'categorias/produtos';

}
