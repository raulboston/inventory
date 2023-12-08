<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosController;
use App\Http\Middleware\VerifyCsrfToken;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/{CorreoElectronico}',[DatosController::class, 'loginUsuario']);
Route::get('/loginMovil',[DatosController::class, 'loginMovil'])->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/registro',[DatosController::class, 'registrarUsuario']);
Route::post('/registro',[DatosController::class, 'registrarUsuario'])->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/guardar-articulo', [DatosController::class, 'guardarArticulo']);
Route::post('/guardar-articulo', [DatosController::class, 'guardarArticulo'])
->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/obtener-datos-inventory', [DatosController::class, 'obtenerDatosParaSpinner']);
Route::get('/departamentos', [DatosController::class, 'mostrarDepartamentos']);
Route::get('/aulas', [DatosController::class, 'mostrarAulas']);
Route::get('/articulos', [DatosController::class, 'mostrarArticulos']);
Route::get('/articulos/{codigoBarras}', [DatosController::class, 'consultarPorCodigoBarras']);
Route::get('/articulos-con-filtros', [DatosController::class, 'obtenerArticulosConFiltros']);
Route::get('/obtener-nombre-departamento/{departamentoId}', [InventarioController::class, 'obtenerNombreDepartamento']);
Route::get('/obtener-nombre-encargado/{encargadoId}', [InventarioController::class, 'obtenerNombreEncargado']);


