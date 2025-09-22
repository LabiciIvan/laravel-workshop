<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomClassesInteractionController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\UserController;
use App\Jobs\ReconcileAccount;
use Illuminate\Support\Facades\Log;
use App\Models\User;

// Queue work.
Route::resource('user', UserController::class);


Route::prefix('class')->group(function () {
    Route::post('/', [CustomClassesInteractionController::class, 'handleClassesInstantiation']);
});


Route::get('/queue', function () {
    Log::debug('Hello world');

    $user = User::first();

    // dispatch(new ReconcileAccount);
    ReconcileAccount::dispatch($user);
    
    return response()->json([
        'data' => 'Request received',
    ], 200);
});


// Redis work.
Route::resource('article', ArticleController::class);


Route::prefix('phoneValidation')->group(function () {
    Route::post('requestVerificationCode', [PhoneVerificationController::class, 'sendVerificationCode']);
    Route::post('validateVerificationCode', [PhoneVerificationController::class, 'validateVerificationCode']);
});
