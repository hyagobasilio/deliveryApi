<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'photo', 'tipo_produto_id'];


    public function likes() {
    	return $this->hasMany('App\LikeProduto');
    }

    

}
