<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource("/category", CategoriesController::class)->middleware("auth");
Route::resource("/post", PostsController::class)->middleware("auth");

Route::get('/c/{id}/{slug}', [HomeController::class, 'getCategory'])->name('category.single');
Route::get('/p/{id}/{slug}', [HomeController::class, 'getPost'])->name('posts.single');

require __DIR__.'/auth.php';
