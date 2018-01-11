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
    	'status',
    	'user_id'
    ];

    public function itens(){
        return $this->hasMany('App\ListaProduto');
    }    

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function colorStatus() {
        $color = 'default';
        switch ($this->status) {
            case 'aguardando':
                $color = 'info';
                break;
            case 'produzindo':
                $color = 'warning';
                break;
            case 'entregue':
                $color = 'success';
                break;
        }
        return $color;
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
