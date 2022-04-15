<?php

use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;

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
Route::get('/adm', function () {
    return view('adm_docentes');
});
Route::get('/seccion', [SectionsController::class, 'index'])->name('secciones');

Route::post('/seccion', [SectionsController::class, 'store'])->name('secciones');

Route::get('/seccion/{id}', [SectionsController::class, 'show'])->name('secciones-show');
Route::patch('/seccion/{id}', [SectionsController::class, 'update'])->name('secciones-update');
Route::delete('/seccion/{id}', [SectionsController::class, 'destroy'])->name('secciones-destroy');

Route::get('/aula', function () {
    return view('adm_aulas');
});

Route::resource('materia', MateriaController::class);