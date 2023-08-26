<?php

use App\Http\Controllers\CartasController;
use App\Http\Controllers\ChollosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get("/cartas",[CartasController::class,"lista"]);
Route::post("/cartas/post",[CartasController::class,"listaFiltro"]);

