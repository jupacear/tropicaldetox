<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\pedidoController;
use App\Http\Controllers\ventasController;
use App\Http\Controllers\CategoriumController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InsumoController;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(['role:administrador'])->group(function () {
    Route::get('/admin/dashboard', [UsuarioController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [UsuarioController::class, 'clienteDashboard'])->name('cliente.dashboard');
});






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);

    //clientes
    Route::get('/A_clientes', [UsuarioController::class, 'indexc'])->name('A_clientes.index');
    Route::get('/A_clientes/create', [UsuarioController::class, 'createc'])->name('A_clientes.create');
    Route::post('/A_clientes', [UsuarioController::class, 'storec'])->name('A_clientes.store');
    Route::get('/A_clientes/{id}', [UsuarioController::class, 'showc'])->name('A_clientes.show');
    Route::get('/A_clientes/{id}/edit', [UsuarioController::class, 'editc'])->name('A_clientes.edit');
    Route::match(['put', 'patch'], '/A_clientes/{id}', [UsuarioController::class, 'updatec'])->name('A_clientes.update');
    Route::delete('/A_clientes/{id}', [UsuarioController::class, 'destroyc'])->name('A_clientes.destroy');

    // modulos de Johan 

    Route::put('/pedidos/{id}/updateEstado', [pedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');
    Route::resource('pedidos',  pedidoController::class);
    Route::get('/ventas/graficatop10', [ventasController::class, 'graficatop10'])->name('ventas.graficatop10');
    Route::get('/ventas/informe', [ventasController::class, 'informe'])->name('ventas.informe');
    Route::resource('ventas', ventasController::class);


    // diego

    Route::resource('Categorias', CategoriumController::class)->names('categoria');
    Route::resource('Productos', ProductoController::class)->names('productos');
    Route::resource('Insumos', InsumoController::class)->names('insumo');
});
