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
require __DIR__ . '/auth.php';

//users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/destroy/{users}', [UserController::class, 'destroy'])->name('users.destroy');

//grupo economico
Route::get('/grupos-economico', [GrupoEconomicoController::class, 'index'])->name('grupos-economico.index');
Route::get('/grupo-economico', [GrupoEconomicoController::class, 'create'])->name('grupo-economico.create');
Route::post('/grupo-economico', [GrupoEconomicoController::class, 'store'])->name('grupo-economico.store');
Route::get('/grupo-economico/edit/{id}', [GrupoEconomicoController::class, 'edit'])->name('grupo-economico.edit');
Route::post('/grupo-economico/update/{id}', [GrupoEconomicoController::class, 'update'])->name('grupo-economico.update');
Route::delete('/grupo-economico/destroy/{grupo-economico}', [GrupoEconomicoController::class, 'destroy'])->name('grupo-economico.destroy');

//bandeira
Route::get('/bandeiras', [BandeiraController::class, 'index'])->name('bandeiras.index');
Route::get('/bandeiras/create', [BandeiraController::class, 'create'])->name('bandeiras.create');
Route::post('/bandeiras/store', [BandeiraController::class, 'store'])->name('bandeiras.store');
Route::get('/bandeiras/edit/{id}', [BandeiraController::class, 'edit'])->name('bandeiras.edit');
Route::post('/bandeiras/update/{id}', [BandeiraController::class, 'update'])->name('bandeiras.update');
Route::delete('/bandeiras/destroy/{bandeira}', [BandeiraController::class, 'destroy'])->name('bandeiras.destroy');


//unidades
Route::get('/unidades', [UnidadeController::class, 'index'])->name('unidades.index');
Route::get('/unidades/create', [UnidadeController::class, 'create'])->name('unidades.create');
Route::post('/unidades/store', [UnidadeController::class, 'store'])->name('unidades.store');
Route::get('/unidades/edit/{id}', [UnidadeController::class, 'edit'])->name('unidades.edit');
Route::post('/unidades/update/{id}', [UnidadeController::class, 'update'])->name('unidades.update');
Route::delete('/unidades/destroy/{unidades}', [UnidadeController::class, 'destroy'])->name('unidades.destroy');

//colaborador
Route::get('/colaboradores', [ColaboradorController::class, 'index'])->name('colaboradores.index');
Route::get('/colaboradores/create', [ColaboradorController::class, 'create'])->name('colaboradores.create');
Route::post('/colaboradores/store', [ColaboradorController::class, 'store'])->name('colaboradores.store');
Route::get('/colaboradores/edit/{id}', [ColaboradorController::class, 'edit'])->name('colaboradores.edit');
Route::post('/colaboradores/update/{id}', [ColaboradorController::class, 'update'])->name('colaboradores.update');
Route::delete('/colaboradores/destroy/{colaboradores}', [ColaboradorController::class, 'destroy'])->name('colaboradores.destroy');


//relatorios
Route::get('/relatorios/exportar/pdf', [RelatorioController::class, 'exportarPDF'])->name('relatorios.exportar.pdf');
Route::get('/relatorios/exportar/excel', [RelatorioController::class, 'exportarExcel'])->name('relatorios.exportar.excel');
Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('/relatorio/gerar', [RelatorioController::class, 'gerarPDF'])->name('relatorios.colaborador');
Route::get('/reports', [RelatorioController::class, 'gerarPDF'])->name('report.colaborador');
Route::get('/relatorios/comparacao', [RelatorioController::class, 'comparar'])->name('relatorios.comparacao');
});