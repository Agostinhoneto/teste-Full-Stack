<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';

// 🧑‍💼 Usuários
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
});

// 🏢 Grupo Econômico
Route::prefix('grupo-economico')->name('grupo-economico.')->group(function () {
    Route::get('/', [GrupoEconomicoController::class, 'index'])->name('index');
    Route::get('/create', [GrupoEconomicoController::class, 'create'])->name('create');
    Route::post('/store', [GrupoEconomicoController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GrupoEconomicoController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [GrupoEconomicoController::class, 'update'])->name('update');
    Route::delete('/destroy/{grupoEconomico}', [GrupoEconomicoController::class, 'destroy'])->name('destroy');
});

// 🏴 Bandeira
Route::prefix('bandeira')->name('bandeira.')->group(function () {
    Route::get('/', [BandeiraController::class, 'index'])->name('index');
    Route::get('/create', [BandeiraController::class, 'create'])->name('create');
    Route::post('/store', [BandeiraController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BandeiraController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [BandeiraController::class, 'update'])->name('update');
    Route::delete('/destroy/{bandeira}', [BandeiraController::class, 'destroy'])->name('destroy');
});

// 🏬 Unidades
Route::prefix('unidades')->name('unidades.')->group(function () {
    Route::get('/', [UnidadeController::class, 'index'])->name('index');
    Route::get('/create', [UnidadeController::class, 'create'])->name('create');
    Route::post('/', [UnidadeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UnidadeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UnidadeController::class, 'update'])->name('update');
    Route::delete('/destroy/{unidade}', [UnidadeController::class, 'destroy'])->name('destroy');
});

// 👨‍💼 Colaborador
Route::prefix('colaborador')->name('colaborador.')->group(function () {
    Route::get('/', [ColaboradorController::class, 'index'])->name('index');
    Route::get('/create', [ColaboradorController::class, 'create'])->name('create');
    Route::post('/', [ColaboradorController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ColaboradorController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ColaboradorController::class, 'update'])->name('update');
    Route::delete('/destroy/{colaborador}', [ColaboradorController::class, 'destroy'])->name('destroy');
});

// 📊 Relatórios
Route::prefix('relatorios')->name('relatorios.')->group(function () {
    Route::get('/exportar/pdf', [RelatorioController::class, 'exportarPDF'])->name('exportar.pdf');
    Route::get('/exportar/excel', [RelatorioController::class, 'exportarExcel'])->name('exportar.excel');
    Route::get('/', [RelatorioController::class, 'index'])->name('index');
    Route::get('/gerar', [RelatorioController::class, 'gerarPDF'])->name('gerar.pdf');
    Route::get('/comparacao', [RelatorioController::class, 'comparar'])->name('comparacao');
});

// 📌 Alias para Reports
Route::get('/reports', [RelatorioController::class, 'gerarPDF'])->name('reports.colaborador');
