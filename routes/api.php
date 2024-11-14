<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\TinacoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LecturaController;

/*--------------------------------------------------------------------------*/

Route::get('', function () {
    return response()->json([
        'message' => 'Index de Rotoplas Team',
    ]);
});

Route::post('user', [UserController::class, 'create']);

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('/activate/{user}', [AuthController::class, 'activateAccount'])->name('activate.account')->middleware('signed'); 
Route::post('/resend-activation', [AuthController::class, 'resendActivation']);
Route::get('/authorize-user-role/{user}', [AuthController::class, 'authorizeUserRole'])->name('authorize.user.role');
Route::post('token-command', [TokenController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('secret', function () {
        return response()->json([
            'message' => 'El token sí está funcionando',
        ]);
    });

    //------------------------ ADMINISTRADOR
    Route::group(['middleware' => ['roleCustom:Administrador']], function () {

        Route::get('adminsecret', function () {
            return response()->json([
                'message' => 'El middleware de admin sí está funcionando',
            ]);
        });

        Route::put('user/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('user/{id}', [UserController::class, 'delete'])->where('id', '[0-9]+');
    });

});