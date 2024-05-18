<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('auth.login');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');


Route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');

Route::get('/passreset', [SessionsController::class, 'reset'])
    ->middleware('guest')
    ->name('passreset.reset');

    
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin.index');

    Route::get('/createuser', [AdminController::class, 'createuser'])
    ->middleware('auth.admin')
    ->name('admin.createuser');

    Route::post('/useradd', [AdminController::class, 'store'])
    ->name('useradd.store');

    Route::post('usuarios/seleccion', [AdminController::class, 'storeSeleccion'])
    ->name('usuarios.storeSeleccion');

    Route::get('/edituser/{id}', [AdminController::class, 'editUser'])
    ->middleware('auth.admin')
    ->name('admin.edituser');

    Route::post('/edituser/{id}', [AdminController::class, 'updateUser'])
    ->name('edituser.updateUser');

    //Route::post('/updateuser', 'AdminController@updateuser')->name('updateuser');

    Route::post('/cambiar-estado', 'AdminController@cambiarEstado')->name('cambiar-estado');

    Route::get('/createmateria', [AdminController::class, 'createmateria'])
    ->middleware('auth.admin')
    ->name('admin.createmateria');

    Route::post('/materiaadd', [AdminController::class, 'materiaadd'])
    ->middleware('auth.admin')
    ->name('materiaadd.store1');

    Route::get('/createcurso', [AdminController::class, 'createcurso'])
    ->middleware('auth.admin')
    ->name('admin.createcurso');

    Route::post('/cursoadd', [AdminController::class, 'cursoadd'])
    ->middleware('auth.admin')
    ->name('cursoadd.store2');

    Route::get('/editmateria/{id}', [AdminController::class, 'editMateria'])
    ->middleware('auth.admin')
    ->name('admin.editmateria');

    Route::post('/editmateria/{id}', [AdminController::class, 'updateMateria'])
    ->name('editmateria.updateMateria');

    Route::post('index/{id}', [AdminController::class, 'destroy'])
    ->name('index.destroy');



    Route::get('/docente', [DocenteController::class, 'index'])
    ->middleware('auth.docente')
    ->name('docente.index');

    Route::get('/asignatura', [DocenteController::class, 'materias'])
    ->middleware('auth.docente')
    ->name('docente.asignatura');

    Route::get('/cursos', [DocenteController::class, 'curso'])
    ->middleware('auth.docente')
    ->name('docente.cursos');

    Route::get('/generar-qr', [DocenteController::class, 'generarQR'])
    ->name('generar-qr.generarQR');

    Route::get('/show/{id}', [DocenteController::class, 'show'])
    ->middleware('auth.docente')
    ->name('docente.show');

    Route::get('/asistencias/{materia}', [DocenteController::class, 'detalle'])
    ->middleware('auth.docente')
    ->name('docente.asistencias');

    Route::post('/asistencias/{materia}', [DocenteController::class, 'detalle'])
    ->name('docente.asistencias');

    Route::post('/usuarios/storeSeleccion', [DocenteController::class, 'storeSeleccion'])
    ->name('usuarios.storeSeleccion');
   

    Route::get('/estudiante', [EstudianteController::class, 'index'])
    ->middleware('auth.estudiante')
    ->name('estudiante.index');

    Route::get('/asignatura', [EstudianteController::class, 'materias'])
    ->middleware('auth.estudiante')
    ->name('estudiante.asignatura');

    Route::post('/guardar-asistencia', [EstudianteController::class, 'guardarRegistro'])
    ->name('guardar-asistencia.guardarRegistro');

    Route::get('/estudiante/detalles/{code}', [EstudianteController::class, 'detalle'])
    ->name('estudiante.detalles');
    

    return __DIR__.'/login.php';

    Route::resource('registros', RegistroController::class);
    Route::get('/materias/{materia}', EstudianteController::class, 'detalle');

    //Route::resource('admin', App\Http\Controllers\AdminController::class);