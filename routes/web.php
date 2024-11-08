<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\FacturaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PQRController;


// Ruta principal (home)
Route::get('/', function () {
    return view('home');
});

// Rutas de autenticación (login y register)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta al Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas de usuarios autenticados (middleware auth)
Route::middleware(['auth'])->group(function () {

    // Rutas de Usuarios
    Route::resource('usuarios', UserController::class);

    // Rutas de Clientes
    Route::resource('clientes', ClienteController::class);

    // Rutas de Productos
    Route::get('/productos-cliente', [ProductoController::class, 'indexCliente'])->name('productos.index_cliente');
    Route::resource('productos', ProductoController::class);
    // Ruta para el cliente

    // Rutas de Servicios
    Route::get('/servicios-cliente', [ServicioController::class, 'indexCliente'])->name('servicios.index_cliente');
    Route::resource('servicios', ServicioController::class);

    // Rutas de Facturas
    Route::resource('facturas', FacturaController::class);

    Route::get('/pqr-cliente', [PQRController::class, 'indexCliente'])->name('pqr.index_cliente');
    Route::resource('pqr', PQRController::class);
});

// Rutas de administración con rol de 'admin'
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Aquí puedes agregar rutas específicas para la administración si las necesitas
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});
