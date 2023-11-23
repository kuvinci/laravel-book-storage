<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Livewire\Component;

class BookForm extends Component
{
    public $title, $author, $comments, $rating, $publication_year, $tags = [];

    public function submit()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'comments' => 'nullable|string|max:255',
            'rating' => ['nullable', 'numeric', 'max:10', 'regex:/^\d+(\.\d{1})?$/'],
            'publication_year' => 'nullable|numeric|digits:4|between:1900,' . Carbon::now()->year
        ]);

        $book = Book::create($validatedData);
        $book->tags()->attach($this->tags);

        // Reset form fields or perform further actions
        $this->reset();
    }

    public function render()
    {
        return view('livewire.book-form', [
            'allTags' => Tag::all()
        ]);
    }
}
