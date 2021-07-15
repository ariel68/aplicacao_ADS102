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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {return view('home');});
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/clientes' , 'ClienteController@index');
    Route::get('/clientes/new' , 'ClienteController@new');
    Route::get('/cliente/edit/{idCliente}' , 'ClienteController@edit');
    Route::post('/clientes/post' , 'ClienteController@post');
    Route::any('/clientes/put' , 'ClienteController@put');
    Route::get('/cliente/delete/{idCliente}' , 'ClienteController@delete');
    Route::post('/cliente/search' , 'ClienteController@search');
    Route::post('/clientes/order' , 'ClienteController@order');

    Route::get('/produtos' , 'ProdutoController@index');
    Route::get('/produtos/new' , 'ProdutoController@new');
    Route::get('/produto/edit/{idProduto}' , 'ProdutoController@edit');
    Route::post('/produto/post' , 'ProdutoController@post');
    Route::any('/produtos/put' , 'ProdutoController@put');
    Route::get('/produto/delete/{idProduto}' , 'ProdutoController@delete');
    Route::post('/produto/search' , 'ProdutoController@search');
    Route::post('/produtos/order' , 'ProdutoController@order');

    Route::get('/pedidos' , 'PedidoController@index');
    Route::post('/pedidos/new' , 'PedidoController@new');
    Route::get('/pedido/excluir/{numeroPedido}' , 'PedidoController@delete');
    Route::get('/pedido/edit/{NumeroPedido}' , 'PedidoController@pedidoDetalhe');
    Route::post('/pedido/search' , 'PedidoController@search');
    Route::post('/pedidos/order' , 'PedidoController@order');
    Route::post('/pedidos/pedidocliente' , 'PedidoController@pedidoCliente');
    Route::post('/pedido/trocastatus' , 'PedidoController@trocaStatus');
    Route::get('/pedidos/delete/produtopedido/{NumeroPedido}/{idProduto}' , 'PedidoController@deleteProdutoPedido');
    Route::get('/pedidos/edit/itempedido/{NumeroPedido}/{idProduto}/{quantidade}' , 'PedidoController@editProdutoPedido');
});
