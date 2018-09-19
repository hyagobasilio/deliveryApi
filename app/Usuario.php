<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    
    public $timestamps = false;
    protected $fillable = ['usuario',
     'senha'
    ];


    public function santinhos() {
    	return $this->hasMany('App\Santinho');
    }
}
