<?php

use Illuminate\Support\Facades\Route;
//agregamos los controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PoderController;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\MiscapacitacionController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ExpedienteController;

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
    //return view('auth/login');
    return view('welcome');
});

// Gate::authorize('see-reports'); 
    Route::post('/poder', [App\Http\Controllers\PoderController::class, 'show'])->name('poder');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Calendario
    Route::get('calendar-event', [CalenderController::class, 'index'])->name('calendario');
    Route::get('calendario_horario/{fecha}', [CalenderController::class, 'calendario_horario'])->name('calendario.horario');
    Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);
//Fin Calenadrio

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    //Capacitaciones
        Route::get('/capacitaciones/personas',                      [CapacitacionController::class, 'personas'])->name('capacitaciones.personas');
        Route::get('/capacitaciones/personas_documentos/{id}',      [CapacitacionController::class, 'personas_documentos'])->name('personas.documentos');
        Route::get('/capacitaciones/modulos/{id}',                  [CapacitacionController::class, 'modulos'])->name('capacitaciones.modulos');
        Route::get('/capacitaciones/crear_modulo/{id}',             [CapacitacionController::class, 'crear_modulo'])->name('capacitaciones.nuevo_modulo');
        Route::get('/capacitaciones/borrar_modulo//{id}/{mod}',     [CapacitacionController::class, 'borrar_modulo'])->name('capacitaciones.borrar');
        Route::get('/capacitaciones/editar_modulo/{id}',            [CapacitacionController::class, 'editar_modulo'])->name('capacitaciones.editar_modulo');
        Route::get('/capacitaciones/editar_encuesta/{id}/{mod}',    [CapacitacionController::class, 'editar_encuesta'])->name('capacitaciones.editar_encuesta');
        Route::get('/capacitaciones/agregar_personas/{id}',         [CapacitacionController::class, 'agregar_personas'])->name('capacitaciones.addpersonas');
        Route::get('/capacitaciones/persona_incluir/{cap}/{per}',   [CapacitacionController::class, 'persona_incluir'])->name('capacitaciones.agregar_persona');
        Route::get('/capacitaciones/persona_quitar/{cap}/{per}',    [CapacitacionController::class, 'persona_quitar'])->name('capacitaciones.quitar_persona');
        Route::get('/capacitaciones/personas_calificacion/{cap}',   [CapacitacionController::class, 'personas_calificacion'])->name('capacitaciones.calificaciones');    
        Route::post('/capacitaciones/guardar_encuesta_editar',      [CapacitacionController::class, 'guardar_encuesta_editar'])->name('capacitaciones.guardar_encuesta_editar');
        Route::post('/capacitaciones/guardar_modulo',               [CapacitacionController::class, 'guardar_modulo'])->name('capacitaciones.crear_modulo');
        Route::post('/capacitaciones/guardar_modulo_editar',        [CapacitacionController::class, 'guardar_modulo_editar'])->name('capacitaciones.editar_modulo_guardar');
    //Fin capacitaciones

    //Mis capacitaciones
        Route::get('/miscapacitaciones/iniciar/{id}/{mod}',    [MiscapacitacionController::class, 'iniciar'])->name('miscapacitaciones.iniciar');
        Route::get('/miscapacitaciones/evaluacion/{id}/{mod}', [MiscapacitacionController::class, 'evaluacion'])->name('miscapacitaciones.prueba');
        Route::post('/miscapacitaciones/guardar_respuestas',   [MiscapacitacionController::class, 'guardar_respuestas'])->name('miscapacitaciones.guardar_respuestas');
    //Fin mis capacitaciones

    //Expediente
        Route::get('/expedientes/personas_documentos/{id}', [ExpedienteController::class, 'personas_documentos'])->name('expedientes.documentos');
    //Fin expediente
    
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('poderes', PoderController::class);
    Route::resource('capacitaciones', CapacitacionController::class);
    Route::resource('miscapacitaciones', MiscapacitacionController::class);
    Route::resource('expedientes', ExpedienteController::class);


    
});

