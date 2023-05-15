<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')
    ->name('api.')
    ->group(function () {

        // region api version 1
        Route::pattern('apiVersion1', 'v[1]');
        Route::namespace('V1')
            ->name('v1.')
            ->prefix('{apiVersion1}')
            ->group(function () {

                // region auth
                Route::prefix('auth')
                    ->name('auth.')
                    ->group(function () {

                        Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'index'])->name('register');
                        Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'index'])->name('login');
                        Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LogoutController::class, 'index'])->name('logout');

                    });
                // endregion auth

            });
        // endregion api version 1

        // region api version all
        Route::pattern('apiVersionAll', 'v[0-9]+');
        Route::namespace('V0')
            ->name('v0.')
            ->prefix('{apiVersionAll}')
            ->group(function () {

                // region test
                Route::prefix('test')
                    ->name('test.')
                    ->group(function () {
                        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Api\V0\Test\TestController::class, 'index'])->name('index');
                    });
                // endregion test
            });
        // endregion api version all

    });
