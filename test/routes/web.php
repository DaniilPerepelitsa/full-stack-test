<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}/posts', [PostController::class, 'getPostsForCategory']);
    Route::get('/post/{id}/', [PostController::class, 'show']);
    Route::post('/posts/search', [PostController::class, 'searchPosts']);
});
Route::get('/test', [SpaController::class, 'test']);
Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');
