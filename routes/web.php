<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GoogleSearchController;
use App\Http\Controllers\TagController;
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

Route::get('/books/add', [BookController::class, 'index'])->name('add-book');
Route::get('/books/edit/{bookId}', [BookController::class, 'edit'])->name('edit-book');

Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::get('/tags/add', [TagController::class, 'create'])->name('add-tag');
Route::get('/tags/edit/{tagId}', [TagController::class, 'edit'])->name('edit-tag');
Route::get('/tags/delete/{tagId}', [TagController::class, 'delete'])->name('delete-tag');
