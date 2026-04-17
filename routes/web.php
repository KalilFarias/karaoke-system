<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PubController;
use Illuminate\Support\Facades\Route;

// 🔥 Página inicial → vai direto pra fila (ajuste o slug)
Route::get('/', function () {
    return redirect('/pub/meu-karaoke');
});

// 🔓 Público (ver fila)
Route::get('/pub/{slug}', [PubController::class, 'show'])->name('pub.show');

// 🔐 Dashboard padrão
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Protegido (ações)
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // entrar na fila
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');

    Route::post('/pub/{pub}/call-next', [SongController::class, 'callNext'])
        ->name('songs.callNext');

    Route::post('/songs/{id}/finish', [SongController::class, 'finish'])
        ->name('songs.finish');
    Route::delete('/songs/{id}', [SongController::class, 'destroy'])
        ->middleware('auth')
        ->name('songs.destroy');
});

require __DIR__ . '/auth.php';