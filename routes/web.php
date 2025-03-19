<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/buscar', [WebController::class, 'buscar'])->name('buscar');
Route::get('/inscripcion', [WebController::class, 'inscripcion'])->name('inscripcion');
Route::get('/gracias', [WebController::class, 'inscripcionGracias'])->name('inscripcion.gracias');
Route::get('/inscripcion/subcategorias/{categoria}', [WebController::class, 'getSubcategorias'])->name('inscripcion.get.subcategorias');
Route::get('/negocios/{categoria}/{subcategoria?}', [WebController::class, 'categoria'])->name('negocios');
Route::get('/negocio/{negocio}', [WebController::class, 'negocio'])->name('negocio');
Route::get('/get/categorias', [WebController::class, 'getCategorias'])->name('get.categorias');
Route::post('/new', [WebController::class, 'inscripcionCreate'])->name('inscripcion.new');
