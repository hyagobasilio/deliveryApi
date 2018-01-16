<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Product;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos   = Product::all();
        $pedidos    = Pedido::all();
        $clientes   = User::where('admin',0);
        return view('home', compact('produtos', 'pedidos', 'clientes'));
    }
}
