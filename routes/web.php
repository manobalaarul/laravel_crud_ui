<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index'])->name('home');
Route::post('/add_student', [StudentController::class, 'add_student']);
Route::get('/del_student', [StudentController::class, 'del_student']);
Route::get('/edit_student/{id}', [StudentController::class, 'edit_student']);
Route::put('/update_student/{id}', [StudentController::class, 'update_student'])->name('update_student');
