<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Desenvolvedor;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//buscar todos os registros
Route::get('/developer','DesenvolvedorController@buscarTodosRegistros');

//busca os registros pelos parametros passado por querystring
Route::get('developer/queryParam/{campo}={valor}', 'DesenvolvedorController@buscarQueryString');

//busca um registro pelo id passado
Route::get('developer/idParam/{valor}', 'DesenvolvedorController@buscarId');

//cadastra o registro
Route::post('developer/cadastrarDesenvolvedor', 'DesenvolvedorController@cadastrarDesenvolvedor');

//busca os registros
Route::post('developer/buscarDesenvolvedor', 'DesenvolvedorController@buscarDesenvolvedor');

//altera o registro
Route::put('developer/alterarDesenvolvedor', 'DesenvolvedorController@alterarDesenvolvedor');

//deleta o registro
Route::delete('developer/deletarDesenvolvedor/{id}', 'DesenvolvedorController@deletarDesenvolvedor');

