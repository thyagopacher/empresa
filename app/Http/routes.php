<?php

header("Access-Control-Allow-Origin: *");

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */ 

Route::controllers([
    'auth' => 'Auth\AuthController'
]);


Route::get('/', function () {
    return view('auth/login');
});

Route::post('/recuperar_senha', 'HomeController@recuperarSenha');

Route::post('login_app', 'UserController@login_app');
Route::get('salvar_rota_app', 'LocalizacaoController@salvar_rota_app');

Route::get('enviaToken', function () {
    return view('email/enviaToken');
});

Route::get('/senha/recuperar', function () {
    return view('auth/passwords/email');
});
Route::get('/cliente/cadastro', function () {
    return view('cliente/cadastro');
});
Route::get('/fornecedor/cadastro', function () {
    return view('fornecedor/cadastro');
});
Route::get('/conta/ativar', function () {
    return view('auth/ativar');
});

Route::post('inserir_cliente', 'ClienteController@inserir');
Route::post('inserir_fornecedor', 'FornecedorController@inserir');

Route::group(['middleware' => 'auth'], function () {// Only authenticated users may enter...
    Route::get('home', 'HomeController@index'); 
    Route::get('perfil', 'HomeController@perfil'); 
    Route::post('ativar', 'HomeController@ativar');
    Route::post('/reenvio/token', 'HomeController@reenvio_token');
    
    Route::get('excluirCapa', 'ClienteController@excluirCapa');
    Route::get('excluirImagem', 'ClienteController@excluirImagem');

    Route::post('atualizar_cliente', 'ClienteController@atualizar');
    Route::get('ativar_cliente', 'ClienteController@ativar');

    Route::get('atualizar_fornecedor', 'FornecedorController@atualizar');
    Route::get('ativar_fornecedor', 'FornecedorController@ativar');

    Route::post('upload_capa', 'HomeController@upload_capa'); 
    Route::post('upload_foto', 'HomeController@upload_foto');
 
    Route::post('cortar_capa', 'HomeController@cortar_capa');
    Route::get('mostraCapa', 'HomeController@mostraCapa');
});

Route::auth();

