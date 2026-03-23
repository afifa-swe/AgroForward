<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'app'    => config('app.name'),
        'time'   => now()->toISOString(),
    ]);
});

Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1');

Route::prefix('contact-messages')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::get('/{contactMessage}', [ContactController::class, 'show']);
    Route::delete('/{contactMessage}', [ContactController::class, 'destroy']);
});
