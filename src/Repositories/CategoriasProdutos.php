<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class CategoriasProdutos extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'categorias/produtos';
}
