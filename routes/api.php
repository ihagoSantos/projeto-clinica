<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AtendimentoController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas para manipulação de profissionais (GET, POST, PUT e DELETE)
Route::resource('/profissional', ProfissionalController::class);
// Rotas para manipulação de pacientes (GET, POST, PUT e DELETE)
Route::resource('/paciente', PacienteController::class);
// Rotas para manipulação de atendimentos
Route::resource('/atendimento', AtendimentoController::class);
Route::put('/atendimento/finalizar/{id}', [AtendimentoController::class, 'finalizar_atendimento']);