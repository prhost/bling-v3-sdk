<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class Situacoes extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'situacoes';

}