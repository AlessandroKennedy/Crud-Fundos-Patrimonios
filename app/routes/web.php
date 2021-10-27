<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PatrimonioController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[Controller::class, 'dashboardShow']
)->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('/grafico',[Controller::class, 'graficoShow'])->name('graficoShow');
});


Route::prefix('fundos')->group(function () {
    Route::get('/cadastrar',[FundoController::class, 'fundosCadastroShow'])->name('fundosCadastroShow');
    Route::post('/cadastrar',[FundoController::class, 'fundosCadastroStore'])->name('fundosCadastroStore');

    Route::get('/edit',[FundoController::class, 'fundosEditShow'])->name('fundosEditShow');
    Route::post('/edit',[FundoController::class, 'fundosEditStore'])->name('fundosEditStore');

    Route::get('/delete',[FundoController::class, 'fundosDeleteStore'])->name('fundosDeleteStore');

    Route::get('/listar',[FundoController::class, 'fundosList'])->name('fundosList');
});

Route::prefix('patrimonios')->group(function () {
    Route::get('/cadastrar',[PatrimonioController::class, 'patrimoniosCadastroShow'])->name('patrimoniosCadastroShow');
    Route::post('/cadastrar',[PatrimonioController::class, 'patrimoniosCadastroStore'])->name('patrimoniosCadastroStore');

    Route::get('/edit',[PatrimonioController::class, 'patrimoniosEditShow'])->name('patrimoniosEditShow');
    Route::post('/edit',[PatrimonioController::class, 'patrimoniosEditStore'])->name('patrimoniosEditStore');

    Route::get('/delete',[PatrimonioController::class, 'patrimoniosDeleteStore'])->name('patrimoniosDeleteStore');

    Route::get('/listar',[PatrimonioController::class, 'patrimoniosList'])->name('patrimoniosList');
});


require __DIR__.'/auth.php';
