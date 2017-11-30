<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
    	'endereco',
    	'numero',
    	'bairro',
    	'complemento',
    	'troco',
    	'forma_pagamento',
    	'latitude',
    	'longitude',
    	'user_id'
    ];

    public function itens(){
        return $this->hasMany('App\ListaProduto');
    }    

    public function totalPedido()
    {
        $total = 0;
        foreach($this->itens as $item):
            $total += $item->totalItem();
        endforeach;
        return $total;
    }
}
