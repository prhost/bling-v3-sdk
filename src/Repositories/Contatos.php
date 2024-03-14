<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class Contatos extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'contatos';

    protected $queryParam = 'idsContatos';

}