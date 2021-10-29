<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//以下より追加
//------------------------------------------
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::get('/test', function(){
    return 'API is connected!';
});
 
// 最初から用意されている認証
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ユーザー登録
Route::post('/register', [RegisterController::class, 'register']);
// ログイン
Route::post('/login', [LoginController::class, 'login']);
// ログアウト
Route::post('/logout', [LoginController::class, 'logout']);