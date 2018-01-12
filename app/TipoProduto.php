<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_produto';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'foto'];

    public $timestamps = false;

    public function produtos() {
        return $this->hasMany('App\Products', 'tipo_produto_id');
    }
}
