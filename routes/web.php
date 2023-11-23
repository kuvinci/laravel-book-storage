<?php

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

Route::get('/add-book', function () {
    return view('add-book');
})->name('add-book');

Route::get('/add-tag', function () {
    return view('add-tag');
})->name('add-tag');
