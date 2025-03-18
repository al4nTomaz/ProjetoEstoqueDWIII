<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SaidaController;
use App\Http\Controllers\RelatorioController;

Route::view('/', 'welcome');

Route::resource('clientes', ClienteController::class)->names([
    'index' => 'clientes.index',
    'create' => 'clientes.create',
    'store' => 'clientes.store',
    'show' => 'clientes.show',
    'edit' => 'clientes.edit',
    'update' => 'clientes.update',
    'destroy' => 'clientes.destroy',
]);

Route::resource('categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',
    'create' => 'categorias.create',
    'store' => 'categorias.store',
    'show' => 'categorias.show',
    'edit' => 'categorias.edit',
    'update' => 'categorias.update',
    'destroy' => 'categorias.destroy',
]);

Route::resource('unidades', UnidadeController::class)->names([
    'index' => 'unidades.index',
    'create' => 'unidades.create',
    'store' => 'unidades.store',
    'show' => 'unidades.show',
    'edit' => 'unidades.edit',
    'update' => 'unidades.update',
    'destroy' => 'unidades.destroy',
]);

Route::resource('produtos', ProdutoController::class)->names([
    'index' => 'produtos.index',
    'create' => 'produtos.create',
    'store' => 'produtos.store',
    'show' => 'produtos.show',
    'edit' => 'produtos.edit',
    'update' => 'produtos.update',
    'destroy' => 'produtos.destroy',
]);

Route::get('/socialite/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::resource('saidas', SaidaController::class)->names([
    'index' => 'saidas.index',
    'create' => 'saidas.create',     
    'store' => 'saidas.store',       
    'show' => 'saidas.show',         
    'edit' => 'saidas.edit',         
    'update' => 'saidas.update',     
    'destroy' => 'saidas.destroy',   
]);

Route::get('/saidas/create/{produto_id}', [SaidaController::class, 'create'])->name('saidas.create');
Route::get('/saidas', [SaidaController::class, 'index'])->name('saidas.index');
Route::get('/saidas/show', [SaidaController::class, 'show'])->name('saidas.show.produto');

Route::get('saidas/{saida}', [SaidaController::class, 'show'])->name('saidas.show');

Route::get('/produto', [ProdutoController::class, 'index'])->name('produto.index');


Route::get('/relatorios/comEstoque/', [RelatorioController::class, 'comEstoque'])->name('relatorios.comEstoque');
Route::get('/relatorios/semEstoque/', [RelatorioController::class, 'semEstoque'])->name('relatorios.semEstoque');
Route::get('/relatorios/index/', [RelatorioController::class, 'index'])->name('relatorios.index');

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
