<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santinho extends Model
{
    
    public $timestamps = false;
    public $table = 'santinhos';
    protected $fillable = ['titulo',
     'deputado_federal',
     'deputado_estadual',
     'primeiro_senador',
     'segundo_senador',
     'governador',
     'presidente',
     'usuario_id',
     'foto'
    ];


    public function usuario() {
    	return $this->belongsTo('App\Usuario');
    }
}
