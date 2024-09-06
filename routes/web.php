<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

//agregamos los controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PoderController;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\MiscapacitacionController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\SeerController;
use App\Http\Controllers\BlogController;

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



// Gate::authorize('see-reports'); 
    Route::get('publico', [HomeController::class, 'publico'])->name('publico');
    Route::get('home',    [HomeController::class, 'home'])->name('home');
    Route::get('/poder-crear', [PoderController::class, 'registro'])->name('poder-crear');
    Route::get('/poder', [App\Http\Controllers\PoderController::class, 'show'])->name('poder');
    Route::post('/poderes/publico', [PoderController::class, 'publico'])->name('poderes.publico');


//Calendario
    //Route::get('calendar-event', [CalenderController::class, 'index'])->name('calendario');
    //Route::get('calendario_horario/{fecha}', [CalenderController::class, 'calendario_horario'])->name('calendario.horario');
    //Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);
//Fin Calenadrio

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    //Rutas de los menus
        Route::get('/usuarios/index',           [UsuarioController::class, 'index'])->name('usuarios');
        Route::get('/roles/index',              [RolController::class, 'index'])->name('roles');
        Route::get('/capacitaciones/index',     [CapacitacionController::class, 'index'])->name('capacitaciones');
        Route::get('/miscapacitaciones/index',  [MiscapacitacionController::class, 'index'])->name('miscapacitaciones');
        Route::get('/expedientes/index',        [ExpedienteController::class, 'index'])->name('expedientes');
        Route::get('/seer/index',               [SeerController::class, 'index'])->name('seer');
        //Route::redirect("/usuario", "usuarios");
    //Fin de ruta de los menus

    
    //Usuarios
        Route::get('/usuarios/index',           [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/index',           [UsuarioController::class, 'index'])->name('usuarios');
        Route::get('/usuarios/create',          [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::get('/usuarios/edit/{id}',       [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::post('/usuarios/store',          [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::patch('/usuarios/update/{post}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/destroy/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    //Fin de usuarios

    //Roles
        Route::get('/roles/index',           [RolController::class, 'index'])->name('roles.index');
        Route::get('/roles/index',           [RolController::class, 'index'])->name('roles');
        Route::get('/roles/create',          [RolController::class, 'create'])->name('roles.create');
        Route::get('/roles/edit/{id}',       [RolController::class, 'edit'])->name('roles.edit');
        Route::post('/roles/store',          [RolController::class, 'store'])->name('roles.store');
        Route::patch('/roles/update/{post}', [RolController::class, 'update'])->name('roles.update');
        Route::delete('/roles/destroy/{id}', [RolController::class, 'destroy'])->name('roles.destroy');
    //Fin roles

    //Poder
        Route::get('/poderes/index',           [PoderController::class, 'index'])->name('poderes.index');
        Route::get('/poderes/index',           [PoderController::class, 'index'])->name('poderes');
        Route::get('/poderes/create',          [PoderController::class, 'create'])->name('poderes.create');
        Route::get('/poderes/edit/{id}',       [PoderController::class, 'edit'])->name('poderes.edit');
        Route::post('/poderes/store',          [PoderController::class, 'store'])->name('poderes.store');
        Route::patch('/poderes/update/{post}', [PoderController::class, 'update'])->name('poderes.update');
        Route::delete('/poderes/destroy/{id}', [PoderController::class, 'destroy'])->name('poderes.destroy');
    //Fin Poder

    //Capacitaciones
        Route::get('/capacitaciones/index',           [CapacitacionController::class, 'index'])->name('capacitaciones.index');
        Route::get('/capacitaciones/index',           [CapacitacionController::class, 'index'])->name('capacitaciones');
        Route::get('/capacitaciones/create',          [CapacitacionController::class, 'create'])->name('capacitaciones.create');
        Route::get('/capacitaciones/edit/{id}',       [CapacitacionController::class, 'edit'])->name('capacitaciones.edit');
        Route::post('/capacitaciones/store',          [CapacitacionController::class, 'store'])->name('capacitaciones.store');
        Route::patch('/capacitaciones/update/{post}', [CapacitacionController::class, 'update'])->name('capacitaciones.update');
        Route::delete('/capacitaciones/destroy/{id}', [CapacitacionController::class, 'destroy'])->name('capacitaciones.destroy');



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
        Route::get('/miscapacitaciones/index',                         [MiscapacitacionController::class, 'index'])->name('miscapacitaciones.index');
        Route::get('/miscapacitaciones/index',                         [MiscapacitacionController::class, 'index'])->name('miscapacitaciones');
        Route::get('/miscapacitaciones/create',                        [MiscapacitacionController::class, 'create'])->name('miscapacitaciones.create');
        Route::get('/miscapacitaciones/edit/{id}',                     [MiscapacitacionController::class, 'edit'])->name('miscapacitaciones.edit');
        Route::post('/miscapacitaciones/store',                        [MiscapacitacionController::class, 'store'])->name('miscapacitaciones.store');
        Route::patch('/miscapacitaciones/update/{post}',               [MiscapacitacionController::class, 'update'])->name('miscapacitaciones.update');
        Route::delete('/miscapacitaciones/destroy/{id}',               [MiscapacitacionController::class, 'destroy'])->name('miscapacitaciones.destroy');

        Route::get('/miscapacitaciones/iniciar/{id}/{mod}',            [MiscapacitacionController::class, 'iniciar'])->name('miscapacitaciones.iniciar');
        Route::get('/miscapacitaciones/evaluacion/{id}/{mod}',         [MiscapacitacionController::class, 'evaluacion'])->name('miscapacitaciones.prueba');
        Route::post('/miscapacitaciones/guardar_respuestas',           [MiscapacitacionController::class, 'guardar_respuestas'])->name('miscapacitaciones.guardar_respuestas');
    //Fin mis capacitaciones
    
    //Expedientes
        Route::get('/expedientes/index',                         [ExpedienteController::class, 'index'])->name('expedientes.index');
        Route::get('/expedientes/index',                         [ExpedienteController::class, 'index'])->name('expedientes');
        Route::get('/expedientes/edit/{id}',                     [ExpedienteController::class, 'edit'])->name('expedientes.edit');
        Route::get('/expedientes/create',                        [ExpedienteController::class, 'create'])->name('expedientes.create');
        Route::post('/expedientes/store',                        [ExpedienteController::class, 'store'])->name('expedientes.store');
        Route::get('/expedientes/documentos/{id}',               [ExpedienteController::class, 'personas_documentos'])->name('expedientes.documentos');
    //Fin de Expedientes
    
    //Seer
        Route::get('/seer/index',                         [SeerController::class, 'index'])->name('seer.index');
        Route::get('/seer/index',                         [SeerController::class, 'index'])->name('seer');
        Route::get('/seer/edit/{id}',                     [SeerController::class, 'edit'])->name('seer.edit');
        Route::get('/seer/create',                        [SeerController::class, 'create'])->name('seer.create');
        Route::post('/seer/store',                        [SeerController::class, 'store'])->name('seer.store');

        //Estadistica
        Route::get('/seer/estadistica',               [SeerController::class, 'estadistica'])->name('seer.estadistica');
        Route::get('/seer/mostrar',                   [SeerController::class, 'mostrar'])->name('seer.mostar');
    //Fin Seer

    //Ruta por cada tabla para los indezx
        Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    //Estadistica

    //Fin de Estadistica
});

