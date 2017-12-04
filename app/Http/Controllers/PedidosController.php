<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Product;
use App\Pedido;
use Illuminate\Http\Request;

class PedidosController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pedidos = Pedido::where('endereco', 'LIKE', "%$keyword%")
                ->orWhere('numero', 'LIKE', "%$keyword%")
                ->orWhere('bairro', 'LIKE', "%$keyword%")
                ->orWhere('complemento', 'LIKE', "%$keyword%")
                ->orWhere('troco', 'LIKE', "%$keyword%")
                ->orWhere('forma_pagamento', 'LIKE', "%$keyword%")
                ->orderBy('id', 'desc')
                ->paginate($perPage);
        } else {
            $pedidos = Pedido::orderBy('id','desc')->with('user')->paginate($perPage);
        }
        
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('pedidos.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        $p = Pedido::create($requestData);

        return redirect('/pedidos/'.$p->id.'/edit')->with('flash_message', ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Pedido $pedido)
    {
        $users      = User::pluck('name', 'id');
        $produtos   = Product::pluck('name', 'id');
        return view('pedidos.edit', compact('pedido', 'users', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $pedido = Pedido::findOrFail($id);
        $pedido->update($requestData);

        return redirect('/pedidos')->with('flash_message', ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Pedido::destroy($id);

        return redirect('/pedidos')->with('flash_message', ' deleted!');
    }
}
