<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Classes\Collection;

class PedidosVendas extends BaseRepository
{
    protected $uri = 'pedidos/vendas';

    public function gerarNfce($pedidoId)
    {
        return $this->request('POST', $this->uri . '/' . $pedidoId . '/gerar-nfce')->getResponse();
    }
}
