<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnemiaController;
use App\Http\Controllers\Chat2Controller;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\SeveridadController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatRController;
use App\Http\Controllers\ReporteController;

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
    return view('inicio');
});

// Route::get('/', function () {
//     return view('chat');
// });
Route::get('/chat',[HomeController::class,'indexchat'])->name('chat');
// Route::get('/chat', [ChatController::class,'index'])->name('chat.index');
Route::post('/chat', 'App\Http\Controllers\ChatController');
Route::post('/chatR', [ChatRController::class,  '__invoke' ])->name('chatR');
Route::post('/generate-image', [Chat2Controller::class, '__invoke']);
Route::get('/chat2',[HomeController::class,'indexchat2'])->name('chat2');

Route::get('/home',[HomeController::class,'index'])->name('home');
Route::resource('anemia',AnemiaController::class);
Route::resource('tipo',TipoController::class);
Route::resource('severidad',SeveridadController::class);
Route::post('/predecir', [SeveridadController::class, 'predecir'])->name('predecir');
Route::post('/anemia_p', [AnemiaController::class, 'anemia_p'])->name('anemia_p');
Route::post('/tipo_p', [TipoController::class, 'tipo_p'])->name('tipo_p');
Route::get('/registros', [RegistroController::class, 'index'])->name('registros.index');
Route::resource('contacto',ContactoController::class);
Route::get('/registros/grafico/{codigo}', [RegistroController::class, 'obtenerDatosGrafico'])->name('obtener.datos.grafico');
Route::get('/registros/data', [RegistroController::class, 'getData'])->name('registros.data');
Route::get('/buscar-registro/{dni}', [AnemiaController::class, 'buscarRegistro']);
Route::get('/buscar-registro/{dni}', [TipoController::class, 'buscarRegistro']);
Route::get('/buscar-registro/{dni}', [SeveridadController::class, 'buscarRegistro']);
// web.php
Route::get('/registros/{id}', [RegistroController::class, 'show'])->name('registro.show');
Route::post('/reportes/generar', [ReporteController::class, 'generar'])->name('reporte.generar');
