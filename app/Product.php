<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'photo', 'tipo_produto_id'];


    public function likes() {
    	return $this->hasMany('App\LikeProduto');
    }

    public function tipoProduto() {
    	return $this->belongsTo('App\TipoProduto', 'tipo_produto_id');
    }

    public function pedidos() {
    	return $this->hasMany('App\ListaProduto','produto_id', 'id');
    }
}
