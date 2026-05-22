<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Área autenticada
Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect('/dashboard'));
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/jogos', \App\Livewire\ListaJogos::class)->name('jogos.index');
    Route::get('/jogos/{jogo}', \App\Livewire\TelaJogo::class)->name('jogos.show');
    Route::get('/meus-palpites', \App\Livewire\MeusPalpites::class)->name('meus-palpites');

    // Admin
    Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/jogos', \App\Livewire\Admin\GerenciarJogos::class)->name('jogos');
        Route::get('/usuarios', \App\Livewire\Admin\GerenciarUsuarios::class)->name('usuarios');
        Route::get('/configuracoes', \App\Livewire\Admin\Configuracoes::class)->name('configuracoes');
    });
});
