<?php

use App\Http\Controllers\APICarController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//creamos un controlador de recuersos php artisan make:controller apicarcontroller --api


Route::apiResource('APICar', APICarController::class)->middleware('auth.basic'); //para que se tenga que autenticar con el usuario y contraseña de la aplicacion