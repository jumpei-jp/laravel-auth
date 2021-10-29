<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//以下より追加
//------------------------------------------
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemoController;

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

/*
| ユーザー関連
|--------------------------------------------------------------------------
|
*/
// ユーザー登録
Route::post('/register', [RegisterController::class, 'register']);
// ログイン
Route::post('/login', [LoginController::class, 'login']);
// ログアウト
Route::post('/logout', [LoginController::class, 'logout']);
/*
|--------------------------------------------------------------------------
*/


/*
| memoアプリ関連
|--------------------------------------------------------------------------
|
*/
// memoのCRUD操作はログインが必要
Route::middleware('auth:sanctum')->group(function(){
    Route::Resource('memo', MemoController::class); //Resourceにする事でrestfulなroutingにこれだけで対応できる。
});
/*
|--------------------------------------------------------------------------
*/
