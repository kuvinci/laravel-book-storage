<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function create() {
        return view('book-form-template');
    }

    public function remove() {

    }

    public function edit($bookId) {
        return view('book-form-template', compact('bookId'));
    }

    public function destroy() {

    }

}
