<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomClassesInteractionController;
use App\Jobs\ReconcileAccount;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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


Route::resource('article', ArticleController::class);


Route::get('/redis', function () {

    Redis::incr('test');

    $test = Redis::get('test');

    return $test;
});
