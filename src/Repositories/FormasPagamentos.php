<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class FormasPagamentos extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'formas-pagamentos';
}
