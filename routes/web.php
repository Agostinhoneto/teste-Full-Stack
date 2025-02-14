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

Route::middleware(['auth'])->group(function () {
        // 🧑‍💼 Usuários
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });
    
        // 🏢 Grupo Econômico
        Route::prefix('grupo-economico')->name('grupo-economico.')->group(function () {
            Route::get('/', [GrupoEconomicoController::class, 'index'])->name('index');
            Route::get('/show', [GrupoEconomicoController::class, 'show'])->name('show');
            Route::get('/create', [GrupoEconomicoController::class, 'create'])->name('create');
            Route::post('/', [GrupoEconomicoController::class, 'store'])->name('store');
            Route::get('/{grupoEconomico}/edit', [GrupoEconomicoController::class, 'edit'])->name('edit');
            Route::put('/{grupoEconomico}', [GrupoEconomicoController::class, 'update'])->name('update');
            Route::delete('/{grupoEconomico}', [GrupoEconomicoController::class, 'destroy'])->name('destroy');
        });
    
        // 🏴 Bandeira
        Route::prefix('bandeira')->name('bandeira.')->group(function () {
            Route::get('/', [BandeiraController::class, 'index'])->name('index');
            Route::get('/show', [BandeiraController::class, 'show'])->name('show');
            Route::get('/create', [BandeiraController::class, 'create'])->name('create');
            Route::post('/', [BandeiraController::class, 'store'])->name('store');
            Route::get('/{bandeira}/edit', [BandeiraController::class, 'edit'])->name('edit');
            Route::put('/{bandeira}', [BandeiraController::class, 'update'])->name('update');
            Route::delete('/{bandeira}', [BandeiraController::class, 'destroy'])->name('destroy');
        });
    
        // 🏬 Unidades
        Route::prefix('unidades')->name('unidades.')->group(function () {
            Route::get('/', [UnidadeController::class, 'index'])->name('index');
            Route::get('/show', [UnidadeController::class, 'show'])->name('show');
            Route::get('/create', [UnidadeController::class, 'create'])->name('create');
            Route::post('/', [UnidadeController::class, 'store'])->name('store');
            Route::get('/{unidade}/edit', [UnidadeController::class, 'edit'])->name('edit');
            Route::put('/{unidade}', [UnidadeController::class, 'update'])->name('update');
            Route::delete('/{unidade}', [UnidadeController::class, 'destroy'])->name('destroy');
        });
    
        // 👨‍💼 Colaborador
        Route::prefix('colaborador')->name('colaborador.')->group(function () {
            Route::get('/', [ColaboradorController::class, 'index'])->name('index');
            Route::get('/show', [ColaboradorController::class, 'show'])->name('show');
            Route::get('/create', [ColaboradorController::class, 'create'])->name('create');
            Route::post('/', [ColaboradorController::class, 'store'])->name('store');
            Route::get('/{colaborador}/edit', [ColaboradorController::class, 'edit'])->name('edit');
            Route::put('/{colaborador}', [ColaboradorController::class, 'update'])->name('update');
            Route::delete('/{colaborador}', [ColaboradorController::class, 'destroy'])->name('destroy');
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
});