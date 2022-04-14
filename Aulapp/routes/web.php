<?php

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
Route::get('/seccion', function () {
    return view('adm_secciones');
});

Route::get('/aula', function () {
    return view('adm_aulas');
});

Route::resource('materia', MateriaController::class);