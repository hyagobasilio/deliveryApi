<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeProduto extends Model
{
    protected 	$table 			= 'like_produtos';
    public 		$timestamps 	= false;
    protected $fillable = ['user_id', 'product_id'];
    public function usuario() {
    	return $this->belongsTo('App\User');
    }
}
