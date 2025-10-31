<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;

Route::get('test', function () {

    TranslateJob::dispatch();
    
    return 'Done';
});

Route::get('/', function () {
    return view('home');
});

Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/show/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/store', [JobController::class, 'store'])->name('jobs.store');
    // Route::get('/edit/{job}', [JobController::class, 'edit'])->name('jobs.edit')->middleware(['auth' => 'can:edit-job,job']); // <- preferred way of authization through middleware
        Route::get('/edit/{job}', [JobController::class, 'edit'])->name('jobs.edit')->middleware(['auth'])->can('edit', 'job'); // <- Another way to keep everything to a model in its own class.

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


Route::get('/register', [RegisterUserController::class, 'create'])->name('register.create');;
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.register');

Route::get('/login', [SessionController::class, 'create'])->name('login.create');
Route::post('/login', [SessionController::class, 'store'])->name('login.login');
Route::post('/logout/{id}', [SessionController::class, 'destroy'])->name('login.logout');

Route::get('/auth/show/{id}', [RegisterUserController::class, 'show'])->name('auth.show');