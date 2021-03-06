<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => [\Barryvdh\Cors\HandleCors::class]], function(){
  Route::get('/user', function (Request $request) {
    return $request->user();
  })->middleware('auth:api');


  Route::get('session','Api\PagSeguroController@getSessionId');

});
Route::post('usuarios', 'UsuariosController@getLogin');
Route::post('usuarios/cadastro', 'UsuariosController@postSalvarSantinho');
Route::post('santinho/delete', 'UsuariosController@postDeleteSantinho');
Route::get('santinho/{id}', 'UsuariosController@getSantinho');

//Route::post('users', 'Api\ProductsController@salvar');
Route::post('users', 'Api\UsersController@register');

//rotas protegidas

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('products','Api\ProductsController@index');
  Route::get('products/category/{id}', 'Api\ProductsController@byCategoriaId');

  Route::get('categorias', 'Api\CategoriasController@index');

  Route::get('users','Api\UsersController@index');
  Route::get('users/logado','Api\UsersController@logado');
  Route::post('users/update', 'Api\UsersController@update');
  Route::post('upload','Api\UsersController@uploadImage');

  Route::get('productsafe','Api\ProductsController@index');
  Route::post('order','Api\OrdersController@store');

  Route::get('pedidos', 'Api\PedidosController@index');
  Route::post('pedidos', 'Api\PedidosController@store');

  Route::post('like-produtos', 'Api\LikeProdutoController@curtir');

});