<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class PedidosVendas extends BaseRepository
{
    use CrudRepository;

    protected $uri = 'pedidos/vendas';

    public function gerarNfce($pedidoId)
    {
        return $this->request('POST', $this->uri . '/' . $pedidoId . '/gerar-nfce')->getResponse();
    }

    public function lancarEstoque($pedidoId)
    {
        return $this->request('POST', $this->uri . '/' . $pedidoId . '/lancar-estoque')->getResponse();
    }
}
