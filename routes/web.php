<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', [PageController::class, 'about']);

Route::get('/articles/report', [ArticleController::class, 'report'])->name('articles.report');

Route::resources([
    'pages' => PageController::class,

    'articles' => ArticleController::class,
    'articles.comments' => ArticleCommentController::class,
]);





