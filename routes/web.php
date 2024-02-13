<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GoogleSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home-page');
})->name('home-page');

Route::get('/books/add', [BookController::class, 'create'])->name('add-book');

Route::get('/books/edit/{bookId}', [BookController::class, 'edit'])->name('edit-book');

Route::get('/add-tag', function () {
    return view('add-tag');
})->name('add-tag');
