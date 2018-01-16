<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaProduto extends Model
{
    protected $table = 'lista_produtos';
    public $timestamps = false;
    protected $fillable = [
    	'produto_id',
    	'observacao',
    	'quantidade',
        'pedido_id',
    	'preco',
    ];

    public function produto() {
    	return $this->belongsTo('App\Product', 'produto_id');
    }

    public function totalItem()
    {
        return $this->quantidade * $this->preco;
    }

}
