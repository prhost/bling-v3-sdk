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

    public function alterarSituacao($pedidoId, $situacaoId)
    {
        return $this->request('PATCH', $this->uri . '/' . $pedidoId . '/situacoes/' . $situacaoId)->getResponse();
    }

    /**
     * Lança as parcelas/contas a receber do pedido no financeiro do Bling.
     * POST /pedidos/vendas/{idPedidoVenda}/lancar-contas
     */
    public function lancarContas($pedidoId)
    {
        return $this->request('POST', $this->uri . '/' . $pedidoId . '/lancar-contas')->getResponse();
    }

    /**
     * Estorna as contas a receber lançadas no financeiro do Bling.
     * POST /pedidos/vendas/{idPedidoVenda}/estornar-contas
     */
    public function estornarContas($pedidoId)
    {
        return $this->request('POST', $this->uri . '/' . $pedidoId . '/estornar-contas')->getResponse();
    }
}
