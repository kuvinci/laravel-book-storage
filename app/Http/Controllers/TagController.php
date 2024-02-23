<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{

    public function index() {
        return view('tags');
    }

    public function delete($tagId) {
        if(!$tagId){
            return redirect()->route('tags');
        }

        Tag::destroy($tagId);
        return redirect()->route('tags');
    }

    public function edit($tagId) {
        return view('tags', compact('tagId'));
    }

}
