<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/alunos', [StudentController::class, 'index'])->name('alunos.index');
Route::get('/alunos/{id}', [StudentController::class, 'show'])->name('alunos.show');
Route::post('/alunos', [StudentController::class, 'store'])->name('alunos.store');
Route::put('/alunos/{id}', [StudentController::class, 'update'])->name('alunos.update');
Route::delete('/alunos/{id}', [StudentController::class, 'destroy'])->name('alunos.destroy');
