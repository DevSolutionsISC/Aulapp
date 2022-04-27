<?php

use App\Http\Controllers\AsignacionDocenteController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MateriaCarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

Route::get('/menu_adm', function () {
    return view('menu_administrador');
});

//--------------------------------Rutas de eliminacion --------------------------------------------------------
Route::get('/eliminar-seccion', [SectionsController::class, 'busqueda'])->name('eliminar-seccion');

Route::get('/eliminar-aula', [AulaController::class, 'busqueda'])->name('eliminar-aula');

Route::get('/eliminar-carrera', [CarrerasController::class, 'busqueda'])->name('eliminar-carrera');

Route::get('/eliminar-materia', [MateriaController::class, 'busqueda'])->name('eliminar-materia');

Route::get('/eliminar-materia-carrera', [MateriaCarreraController::class, 'busqueda'])->name('eliminar-materia-carrera');

Route::get('/eliminar-grupo', [GrupoController::class, 'busqueda'])->name('eliminar-grupo');

Route::get('/eliminar-asignacion-docente', [AsignacionDocenteController::class, 'busqueda'])->name('eliminar-asignacion-docente');

Route::get('/eliminar-docente', [UsuarioController::class, 'busqueda'])->name('eliminar-docente');

Route::delete('/eliminar-docente{usuario}', [UsuarioController::class, 'destroy'])->name('docente-destroy');

Route::delete('/grupo/{id}', [GrupoController::class, 'destroy'])->name('grupos-destroy');

Route::delete('/asignacionDocente/{asignacionDocente}', [AsignacionDocenteController::class, 'destroy'])->name('asignacionDocente-destroy');

Route::delete('/carrera/{carrera}', [CarrerasController::class, 'destroy'])->name('carreras-destroy');

Route::delete('/seccion/{section}', [SectionsController::class, 'destroy'])->name('secciones-destroy');

Route::delete('/aula/{id}', [AulaController::class, 'destroy'])->name('aulas-destroy');

Route::delete('/materia-carreras/{materiaCarrera}', [MateriaCarreraController::class, 'destroy'])->name('materiasCarreras-destroy');

Route::delete('/materia/{materia}', [MateriaController::class, 'destroy'])->name('materias-destroy');

//--------------------------------------------------------------------------------------------

//--------------------Rutas de registro------------------------------------------
Route::get('/carreras', [CarrerasController::class, 'index'])->name('carreras');

Route::post('/carreras', [CarrerasController::class, 'store'])->name('carreras');

Route::get('/seccion', [SectionsController::class, 'index'])->name('secciones');

Route::post('/seccion', [SectionsController::class, 'store'])->name('secciones');

Route::get('/aula', [AulaController::class, 'index'])->name('aulas');

Route::post('/aula', [AulaController::class, 'store'])->name('aulas');

Route::get('/materias', [MateriaController::class, 'index'])->name('materias');

Route::post('/materias', [MateriaController::class, 'store'])->name('materias');

Route::get('/grupos', [GrupoController::class, 'registro'])->name('grupos');

Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos');

Route::get('/docente', [UsuarioController::class, 'registro'])->name('docentes');

Route::post('/docente', [UsuarioController::class, 'store'])->name('docentes');

//-----------------------------------------------------------------------------------

//Reportes
Route::get('/reporte_materia', 'App\Http\Controllers\MateriaController@reporte');
Route::get('/reporte_carrera', 'App\Http\Controllers\CarrerasController@reporte');
Route::get('/reporte_section', 'App\Http\Controllers\SectionsController@reporte');
Route::get('/reporte_aula', 'App\Http\Controllers\AulaController@reporte');
Route::get('/reporte_grupo', 'App\Http\Controllers\GrupoController@reporte');
Route::get('/reporte_docente', 'App\Http\Controllers\UsuarioController@reporte');

//----------------------Rutas de edicion--------------------------------------------------
Route::get('/carreraEdit', [CarrerasController::class, 'showEdit'])->name('carrera_edit');

Route::get('/carrera/{id}', [CarrerasController::class, 'update'])->name('carreras-update');

Route::get('/materiaEdit', [MateriaController::class, 'showEdit'])->name('materia_edit');

Route::get('/materia/{id}', [MateriaController::class, 'update'])->name('materias-update');

Route::get('/seccionEdit', [SectionsController::class, 'showEdit'])->name('seccion_edit');

Route::get('/seccion/{id}', [SectionsController::class, 'update'])->name('seccion-update');

Route::get('/aulaEdit', [AulaController::class, 'showEdit'])->name('aulas_edit');

Route::get('/aula/{id}', [AulaController::class, 'update'])->name('aula-update');

Route::get('/docenteEdit', [UsuarioController::class, 'showEdit'])->name('docentes_edit');

Route::get('/docente/{id}', [UsuarioController::class, 'update'])->name('docente-update');

Route::get('/grupoEdit', [GrupoController::class, 'showEdit'])->name('grupo_edit');

Route::get('/grupo/{id}', [GrupoController::class, 'update'])->name('grupo-update');
//------------------------------------------------------------------------------

Route::get('/materia', 'App\Http\Controllers\MateriaController@reporte');
Route::get('/carrera', 'App\Http\Controllers\CarrerasController@reporte');
Route::get('/section', 'App\Http\Controllers\SectionsController@reporte');
Route::get('/aulas', 'App\Http\Controllers\AulaController@reporte');
Route::get('/grupo', 'App\Http\Controllers\GrupoController@reporte');