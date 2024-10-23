<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('v1:')->group(static function (): void {
    Route::get('/', static fn() => response()->json(request()->route()));

    Route::middleware(['throttle:api'])->group(static function (): void {

        Route::get('user', static fn (Request $request) => $request->user());

        Route::prefix('services')->as('services:')->group(base_path(
            path:'routes/api/services.php'
        ));

        Route::prefix('credentials')->as('credentials:')->group(base_path(
            path:'routes/api/credentials.php'
        ));

        Route::prefix('checks')->as('checks:')->group(base_path(
            path:'routes/api/checks.php'
        ));
    });
});


