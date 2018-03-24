<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;

class EnderecosController extends Controller
{
    
    public function store(Request $request)
    {
    	Endereco::create($request->all());
    	return back()->with('success', 'Endereço adicionado com sucesso!');
    }

    public function destroy(Endereco $endereco)
    {
    	$endereco->delete();
    	return back()->with('success', 'Endereço removido com sucesso!');
    }
}
