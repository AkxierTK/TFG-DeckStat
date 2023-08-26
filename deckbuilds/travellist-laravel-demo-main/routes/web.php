<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/",[Controller::class,'index']);

Route::get("/cargar/cartasAdmin/{num}",[HomeController::class,'cargarAdmin'])->name("cargarAdmin");
Route::post("/lista/buscar",[Controller::class,'listaPost'])->name("listaPost");
Route::post("/lista/buscar/filtro",[Controller::class,'listaPostFiltro'])->name("listaPostFiltro");
Route::post("/pefil/actualizar",[HomeController::class,'foto'])->name("foto");
Auth::routes();

Auth::routes(['verify' => true]);

Route::get("/crear/mazo",[HomeController::class,'crearMazoGet'])->name("crearMazo");
Route::get("/error",[Controller::class,'error'])->name("error");
Route::get("/inicio",[Controller::class,'index'])->name("inicio");

Route::get("/mazos/lista",[Controller::class,'lista'])->name("lista");

Route::get("/mazo/{id}",[Controller::class,'mazoGet'])->name("mazoGet");

Route::post("/mazo/favorito",[HomeController::class,'favoritos'])->name("favoritos");

Route::get("/perfil/{id}",[Controller::class,'perfil'])->name("perfil");
Route::post("crearPost",[HomeController::class ,'crearMazo'])->name("crearMazoPost");
Route::get("logoutM",[HomeController::class ,'logout'])->name("logoutM");
Route::get('/home', 'HomeController@index')->name('home');
Route::delete('/mazo/eliminar/{id}',[HomeController::class ,'eliminar'])->name("eliminar");
Route::post("/mazo/editar",[HomeController::class ,'editarPost'])->name("editarPost");
