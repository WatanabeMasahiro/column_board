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

Route::get('/', [Column_boardController::class, 'indexGet']);
Route::post('/', [Column_boardController::class, 'indexPost']);

Route::get('article', [Column_boardController::class, 'articleGet']);
Route::post('/article', [Column_boardController::class, 'articlePost']);

Route::get('my-article', [Column_boardController::class, 'myArticleGet']);
Route::post('/my-article', [Column_boardController::class, 'myArticlePost']);

Route::get('my-good-article', [Column_boardController::class, 'myGoodArticleGet']);
Route::post('/my-good-article', [Column_boardController::class, 'myGoodArticlePost']);

Route::get('post', [Column_boardController::class, 'postGet']);
Route::post('/post', [Column_boardController::class, 'postPost']);

Route::get('post_confirm', [Column_boardController::class, 'post_confirmGet']);
Route::post('/post_confirm', [Column_boardController::class, 'post_confirmPost']);

Route::get('post_report', [Column_boardController::class, 'post_reportGet']);
Route::post('/post_report', [Column_boardController::class, 'post_reportPost']);


Route::get('update', [Column_boardController::class, 'updateGet']);
Route::post('/update', [Column_boardController::class, 'updatePost']);

Route::get('update_confirm', [Column_boardController::class, 'update_confirmGet']);
Route::post('/update_confirm', [Column_boardController::class, 'update_confirmPost']);

Route::get('update_report', [Column_boardController::class, 'update_reportGet']);
Route::post('/update_report', [Column_boardController::class, 'update_reportPost']);


Route::get('delete_confirm', [Column_boardController::class, 'delete_confirmGet']);
Route::post('/delete_confirm', [Column_boardController::class, 'delete_confirmPost']);

Route::get('delete_report', [Column_boardController::class, 'delete_reportGet']);
Route::post('/delete_report', [Column_boardController::class, 'delete_reportPost']);


Route::get('withdrawal', [Column_boardController::class, 'withdrawalGet']);
Route::post('/withdrawal', [Column_boardController::class, 'withdrawalPost']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
