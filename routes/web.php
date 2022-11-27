<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Column_boardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/* 記事一覧 */
Route::get('/', [Column_boardController::class, 'indexGet']);
Route::post('/', [Column_boardController::class, 'indexPost']);

Route::get('my-article', [Column_boardController::class, 'myArticleGet']);
Route::post('/my-article', [Column_boardController::class, 'myArticlePost']);

Route::get('my-good-article', [Column_boardController::class, 'myGoodArticleGet']);
Route::post('/my-good-article', [Column_boardController::class, 'myGoodArticlePost']);

/* 記事閲覧(記事の詳細内容) */
Route::get('article', [Column_boardController::class, 'articleGet']);
Route::post('/article', [Column_boardController::class, 'articlePost']);

/* 投稿 */
Route::get('post', [Column_boardController::class, 'postGet'])->middleware('auth');
Route::post('/post', [Column_boardController::class, 'postPost'])->middleware('auth');

Route::get('post_confirm', [Column_boardController::class, 'post_confirmGet'])->middleware('auth');
Route::post('/post_confirm', [Column_boardController::class, 'post_confirmPost'])->middleware('auth');

Route::get('post_report', [Column_boardController::class, 'post_reportGet'])->middleware('auth');
Route::post('/post_report', [Column_boardController::class, 'post_reportPost'])->middleware('auth');

/* 更新 */
Route::get('update', [Column_boardController::class, 'updateGet']);
Route::post('/update', [Column_boardController::class, 'updatePost']);

Route::get('update_confirm', [Column_boardController::class, 'update_confirmGet']);
Route::post('/update_confirm', [Column_boardController::class, 'update_confirmPost']);

Route::get('update_report', [Column_boardController::class, 'update_reportGet']);
Route::post('/update_report', [Column_boardController::class, 'update_reportPost']);

/* 削除 */
Route::get('delete_confirm', [Column_boardController::class, 'delete_confirmGet']);
Route::post('/delete_confirm', [Column_boardController::class, 'delete_confirmPost']);

Route::get('delete_report', [Column_boardController::class, 'delete_reportGet']);
Route::post('/delete_report', [Column_boardController::class, 'delete_reportPost']);

/* 退会 */
Route::get('withdrawal', [Column_boardController::class, 'withdrawalGet']);
Route::post('/withdrawal', [Column_boardController::class, 'withdrawalPost']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
