<?php

use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add/url',[UrlController::class, 'store']);
Route::get('user/urls/{user_id}',[UrlController::class, 'index']);
Route::delete('url/delete/{url_id}',[UrlController::class, 'destroy']);
Route::put('urls/{shorten_url}',[UrlController::class, 'update']);
