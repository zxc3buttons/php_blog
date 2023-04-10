<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginController;
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

/**
 * registration and authentication
 */
Route::post('register', [RegisterController::class,'register']);
Route::post('login', [LoginController::class,'login'])->name('login');

/**
 * articles
 */
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('articles', [ArticleController::class,'index']);
    Route::get('articles/{id}', [ArticleController::class,'show']);
    Route::post('articles', [ArticleController::class,'store']);
    Route::put('articles/{id}', [ArticleController::class,'update']);
    Route::delete('articles/{id}', [ArticleController::class,'delete']);
});

/**
 * middlewares
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
