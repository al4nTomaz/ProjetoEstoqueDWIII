<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SaidaController;
use App\Http\Controllers\RelatorioController;
use App\Models\Relatorio;

Route::view('/', 'welcome');

// Rotas de Clientes
Route::resource('clientes', ClienteController::class)->names([
    'index' => 'clientes.index',
    'create' => 'clientes.create',
    'store' => 'clientes.store',
    'show' => 'clientes.show',
    'edit' => 'clientes.edit',
    'update' => 'clientes.update',
    'destroy' => 'clientes.destroy',
]);

// Rotas de Categorias
Route::resource('categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',
    'create' => 'categorias.create',
    'store' => 'categorias.store',
    'show' => 'categorias.show',
    'edit' => 'categorias.edit',
    'update' => 'categorias.update',
    'destroy' => 'categorias.destroy',
]);

// Rotas de Unidades
Route::resource('unidades', UnidadeController::class)->names([
    'index' => 'unidades.index',
    'create' => 'unidades.create',
    'store' => 'unidades.store',
    'show' => 'unidades.show',
    'edit' => 'unidades.edit',
    'update' => 'unidades.update',
    'destroy' => 'unidades.destroy',
]);

// Rotas de Produtos
Route::resource('produtos', ProdutoController::class)->names([
    'index' => 'produtos.index',
    'create' => 'produtos.create',
    'store' => 'produtos.store',
    'show' => 'produtos.show',
    'edit' => 'produtos.edit',
    'update' => 'produtos.update',
    'destroy' => 'produtos.destroy',
]);

// Rotas de Login Social
Route::get('/socialite/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');

// Rotas de Saídas de Estoque
Route::resource('saidas', SaidaController::class)->names([
    'index' => 'saidas.index',
    'create' => 'saidas.create',       // Para registrar uma nova saída
    'store' => 'saidas.store',         // Para salvar a saída
    'show' => 'saidas.show',           // Para exibir os detalhes da saída
    'edit' => 'saidas.edit',           // Para editar uma saída (se necessário)
    'update' => 'saidas.update',       // Para atualizar uma saída
    'destroy' => 'saidas.destroy',     // Para excluir uma saída
]);

// Rotas personalizadas para registrar saídas específicas de um produto
// Route::get('/saidas/create/{produto}', [SaidaController::class, 'create'])->name('saidas.create.produto');
Route::get('/saidas/create/{produto_id}', [SaidaController::class, 'create'])->name('saidas.create');
Route::get('/saidas', [SaidaController::class, 'index'])->name('saidas.index');
Route::get('/saidas/show', [SaidaController::class, 'show'])->name('saidas.show.produto');
// Route::get('/saidas/confirmar/{id}', [SaidaController::class, 'confirmarSaida'])->name('saidas.confirmar');

Route::get('saidas/{saida}', [SaidaController::class, 'show'])->name('saidas.show');

Route::get('/produto', [ProdutoController::class, 'index'])->name('produto.index');


/*Route::resource('relatorios', RelatorioController::class)->names([
    'index' => 'relatorios.index',
    'comEstoque' => 'relatorios.comEstoque',       
    'semEstoque' => 'relatorios.semEstoque',       
    'store' => 'relatorios.store',         
    'show' => 'relatorios.show',           
    'edit' => 'relatorios.edit',           
    'update' => 'relatorios.update',       
    'destroy' => 'relatorios.destroy',     
]);*/

Route::get('/relatorios/comEstoque/', [RelatorioController::class, 'comEstoque'])->name('relatorios.comEstoque');
Route::get('/relatorios/semEstoque/', [RelatorioController::class, 'semEstoque'])->name('relatorios.semEstoque');
Route::get('/relatorios/index/', [RelatorioController::class, 'index'])->name('relatorios.index');
// // Rotas para Relatórios de Retiradas
// Route::prefix('relatorios')->name('relatorios.')->group(function () {
// Route::get('/', [RelatorioController::class, 'index'])->name('index');
// Route::get('/relatorios/{periodo}', [RelatorioController::class, 'index'])->name('relatorios.index');
//     // Route::get('/{periodo}', [RelatorioController::class, 'gerarRelatorio'])->name('gerar');
//     // Route::get('/export/{periodo}', [RelatorioController::class, 'exportarRelatorio'])->name('exportar');
// });



// Dashboard e Perfil
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

// Rotas de Autenticação
require __DIR__.'/auth.php';
