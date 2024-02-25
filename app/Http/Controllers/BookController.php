<?php

namespace App\Http\Controllers;

class BookController extends Controller
{

    public function index() {
        return view('book-form-template');
    }

    public function remove() {

    }

    public function edit($bookId) {
        return view('book-form-template', compact('bookId'));
    }

}
