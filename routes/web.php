<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\NewController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(["GET", "POST"], "/register", function () {  //disable register
    return redirect("/login");
})->name("register");

Route::view('template', 'layouts.bootstrap'); //aktifkan layout template
Route::resource('users', UserController::class);

Route::get('category/recycle', [CategoryController::class, 'recycle'])->name('category.recycle');
Route::get('category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');
Route::delete('category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::resource('category', CategoryController::class);


Route::get('news/recycle', [NewController::class, 'recycle'])->name('news.recycle');
Route::get('news/{id}/restore', [NewController::class, 'restore'])->name('news.restore');
Route::delete('news/{news}/delete', [NewController::class, 'delete'])->name('news.delete');
Route::resource('news', NewController::class);
