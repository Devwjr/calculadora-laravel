<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

Route::get('/calculadora', [CalculadoraController::class, 'index'])->name('calculadora');
Route::post('/calculadora', [CalculadoraController::class, 'calcular'])->name('calcular');
