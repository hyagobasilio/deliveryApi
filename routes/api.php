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

//Route::post('users', 'Api\ProductsController@salvar');
Route::post('users', 'Api\UsersController@register');

//rotas protegidas
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('products','Api\ProductsController@index');
  	Route::get('users/logado','Api\UsersController@logado');
  	Route::get('productsafe','Api\ProductsController@index');
  	Route::post('order','Api\OrdersController@store');

	Route::get('pedidos', 'Api\PedidosController@index');
  	Route::post('pedidos', 'Api\PedidosController@store');
});