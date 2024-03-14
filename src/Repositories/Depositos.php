<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class Depositos extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'depositos';

    protected $queryParam = 'idsDepositos';

}