<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\EventoFinanceirosController;
use App\Http\Controllers\FinancasController;
use App\Http\Controllers\LembretesPagamentoController;
use App\Http\Controllers\ReceitasController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UserController;
use App\Models\Despesas;
use App\Models\FinancialGoal;
use App\Models\Receitas;
use App\Models\User;
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

Route::middleware('auth')->group(function () {
    Route::get('/charts', [ChartController::class, 'index'])->name('charts.index');
});

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{users}', [UserController::class, 'destroy'])->name('users.destroy');

  
//relatorios
  Route::get('/relatorios/exportar/pdf', [RelatorioController::class, 'exportarPDF'])->name('relatorios.exportar.pdf');
  Route::get('/relatorios/exportar/excel', [RelatorioController::class, 'exportarExcel'])->name('relatorios.exportar.excel');
  Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorios.index');
  Route::get('/relatorio/gerar', [RelatorioController::class, 'gerarPDF'])->name('relatorios.despesas');
  Route::get('/reports', [RelatorioController::class, 'gerarPDF'])->name('report.despesas');
  Route::get('/relatorios/comparacao', [RelatorioController::class, 'comparar'])->name('relatorios.comparacao');

