<?php

namespace App\Http\Controllers\Api;
use App\Pedido;
use App\ListaProduto;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PedidosController extends Controller
{
	public function index() {
		return request()->user()->pedidos()->with('itens.produto')->orderBy('id', 'desc')->get();
	}
    public function store(Request $request) 
    {
    	$dados 				= $request->all();
    	$dados['user_id'] 	= request()->user()->id;
    	
    	$pedido = Pedido::create($dados);

    	foreach ($dados['itens'] as $item) {
    		$p = new ListaProduto();
    		$p->produto_id = $item['id'];
    		$p->quantidade = $item['quantidade'];
    		$p->observacao = isset($item['observacao']) ? $item['observacao'] : '';
    		$p->pedido_id  = $pedido->id;
    		$p->save();
    	}
    	
    	return $dados;

    }
}
