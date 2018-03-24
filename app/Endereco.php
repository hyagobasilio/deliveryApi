<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enderecos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rua', 'numero', 'complemento', 'bairro', 'cidade', 'user_id', 'endereco_id'];
}
