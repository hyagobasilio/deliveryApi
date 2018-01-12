<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TipoProduto;

class CategoriasController extends Controller
{
    public function index()
    {
      return TipoProduto::all();
    }

}
