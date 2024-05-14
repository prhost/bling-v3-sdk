<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class ContatosTipos extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'contatos/tipos';
}
