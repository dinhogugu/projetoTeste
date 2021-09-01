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


Route::get('/developer','DesenvolvedorController@buscarTodosRegistros');

Route::get('developer/queryParam/{campo}={valor}', 'DesenvolvedorController@buscarQueryString');

Route::get('developer/idParam/{valor}', 'DesenvolvedorController@buscarId');

Route::post('developer/cadastrarDesenvolvedor', 'DesenvolvedorController@cadastrarDesenvolvedor');

Route::post('developer/buscarDesenvolvedor', 'DesenvolvedorController@buscarDesenvolvedor');

Route::put('developer/alterarDesenvolvedor', 'DesenvolvedorController@alterarDesenvolvedor');

Route::delete('developer/deletarDesenvolvedor/{id}', 'DesenvolvedorController@deletarDesenvolvedor');

