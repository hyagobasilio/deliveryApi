<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
class ProductsController extends Controller
{
    public function index()
    {
      return Product::orderBy('id', 'desc')->get();
    }

}
