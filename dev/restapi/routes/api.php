<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('movies', [MoviesController::class, 'showAll']);

Route::get('movies/{id}', [MoviesController::class, 'showItem']);

Route::post('movies', [MoviesController::class, 'createItem']);

Route::put('movies/{id}', [MoviesController::class, 'updateItem']);

Route::delete('movies/{id}', [MoviesController::class, 'deleteItem']);

Route::fallback(function () {
    return response()->json(['message'=>'not found'], 404);
});