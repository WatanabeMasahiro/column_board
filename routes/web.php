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

Route::get('post', [Column_boardController::class, 'postGet']);
Route::post('/post', [Column_boardController::class, 'postPost']);

Route::get('/my-article', [Column_boardController::class, 'myArticleGet']);
Route::post('/my-article', [Column_boardController::class, 'myArticlePost']);

Route::get('my-good-article', [Column_boardController::class, 'myGoodArticleGet']);
Route::post('my-good-article/', [Column_boardController::class, 'myGoodArticlePost']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
