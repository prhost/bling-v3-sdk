<?php

namespace Prhost\Bling\Repositories;

use Prhost\Bling\Repositories\Traits\CrudRepository;

class FormasPagamentos extends BaseRepository
{
    use CrudRepository;

    public CONST TIPOS_PAGAMENTOS = [
        1 => 'Dinheiro',
        2 => 'Cheque',
        3 => 'Cartão de Crédito',
        4 => 'Cartão de Débito',
        5 => 'Crédito Loja',
        10 => 'Vale Alimentação',
        11 => 'Vale Refeição',
        12 => 'Vale Presente',
        13 => 'Vale Combustível',
        14 => 'Duplicata Mercantil',
        15 => 'Boleto Bancário',
        16 => 'Depósito Bancário',
        17 => 'Pagamento Instantâneo (PIX)',
        18 => 'Transferência Bancária, Carteira Digital',
        19 => 'Programa de Fidelidade, Cashback, Crédito Virtual',
        90 => 'Sem pagamento',
        99 => 'Outros'
    ];

    public CONST BANDEIRAS_CARTAO = [
        1 => 'Visa',
        2 => 'Mastercard',
        3 => 'American Express',
        4 => 'Sorocred',
        5 => 'Diners Club',
        6 => 'Elo',
        7 => 'Hipercard',
        8 => 'Aura',
        9 => 'Cabal',
        99 => 'Outros'
    ];

    public CONST TIPO_INTEGRACAO = [
        1 => 'TEF',
        2 => 'POS'
    ];

    protected $uri = 'formas-pagamentos';
}
