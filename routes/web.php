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
/* Admin */
Route::get('/admin', 'InicialController@admin');
Route::get('/categoria_produtos/grid', 'Categoria_produtosController@grid');
Route::resource('/categoria_produtos', 'Categoria_produtosController');
Route::get('/item_pedidos/grid', 'Item_pedidosController@grid');
Route::resource('/item_pedidos', 'Item_pedidosController');
Route::get('/pedidos/grid', 'PedidosController@grid');
Route::resource('/pedidos', 'PedidosController');
Route::get('/produtos/grid', 'ProdutosController@grid');
Route::resource('/produtos', 'ProdutosController');
Route::get('/status_items/grid', 'Status_itemsController@grid');
Route::resource('/status_items', 'Status_itemsController');
Route::get('/tipo_usuarios/grid', 'Tipo_usuariosController@grid');
Route::resource('/tipo_usuarios', 'Tipo_usuariosController');
Route::get('/usuarios/grid', 'UsuariosController@grid');
Route::resource('/usuarios', 'UsuariosController');
Route::get('/new-usuarios', 'UsuariosController@new_user');
Route::post('/new-usuarios', 'UsuariosController@post_user');
Route::post('/login', 'UsuariosController@login');
Route::post('/pedidos/newitem', 'PedidosController@newitempedido');
Route::delete('/pedidos/delitem/{id}', 'PedidosController@delitempedido');
/* cliente */
Route::get('/cliente', 'InicialController@cliente');
Route::post('/pedido/avaliacao', 'ClienteController@avaliacao');
Route::get('/cliente/pedido', 'ClienteController@pedido');
Route::get('/cliente/pedido/{id}', 'ClienteController@editpedido');
Route::post('/cliente/newitem', 'ClienteController@newitempedido');
Route::delete('/cliente/delitem/{id}', 'ClienteController@delitempedido');
Route::get('/cliente/confirmpedido/{id}', 'ClienteController@confirmpedido');
Route::get('/cliente/perfil/{id}', 'ClienteController@perfil');
Route::put('/cliente/perfil/{id}', 'ClienteController@editperfil');
/*interno*/
Route::get('/atendimento', 'InicialController@atendimento');
Route::get('/cozinha', 'InicialController@cozinha');
Route::put('/interno/pronto/{id}', 'InternoController@pronto');
Route::put('/interno/entregar/{id}', 'InternoController@entregar');
Route::put('/interno/entregue/{id}', 'InternoController@entregue');
Route::put('/interno/cozinha/{id}', 'InternoController@cozinha');
Route::get('/interno/pedido/{id}', 'InternoController@pedido');