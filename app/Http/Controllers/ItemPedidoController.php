<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListaProduto;
class ItemPedidoController extends Controller
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
    public function store(Request $request)
    {
        ListaProduto::create($request->all());
        return redirect("/pedidos/{$request->pedido_id}/edit");
        
    }
    public function destroy(ListaProduto $itemPedido)
    {
        $idPedido = $itemPedido->pedido_id;
        $itemPedido->delete();
        return redirect("/pedidos/{$idPedido}/edit");
    }
}
