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
    public function index(Request $request)
    {
        $produtos   = Product::orderBy('name', 'asc');

        if($request->has('data')) {

            $data = $request->get('data');

            $produtos = $produtos->whereExists(function($query) use ($data) {
                $query->from('lista_produtos')
                ->whereRaw('lista_produtos.produto_id = products.id')
                ->join('pedidos', 'pedidos.id', '=', 'lista_produtos.pedido_id')
                ->whereDate('created_at', $data);
            });

        }

        $produtos = $produtos->get();


        $pedidos    = Pedido::all();
        $clientes   = User::where('admin',0);
        return view('home', compact('produtos', 'pedidos', 'clientes'));
    }
}
