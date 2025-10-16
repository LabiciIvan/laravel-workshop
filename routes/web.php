<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/show/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/store', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/edit/{id}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::delete('/delete/{id}', [JobController::class, 'delete'])->name('jobs.delete');
    Route::put('/update', [JobController::class, 'update'])->name('jobs.update');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact', ['name' => 'John']);
});


Route::get('createJob', [JobController::class, 'store']);


Route::get('/submit/form', function () {
    return "General form received";
});