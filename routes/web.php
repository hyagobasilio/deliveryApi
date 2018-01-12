<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('produtos', 'ProdutosController');

Route::resource('pedidos', 'PedidosController');
Route::resource('usuarios', 'UsuariosController');
Route::post('itens-pedido', 'ItemPedidoController@store');
Route::delete('itens-pedido/{itemPedido}', 'ItemPedidoController@destroy');


Route::resource('tipo-produto', 'TipoProdutoController');