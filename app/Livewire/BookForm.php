<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Livewire\Component;

class BookForm extends Component
{
    public function submit()
    {
        $validatedData = $this->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'comments' => 'max:255',
            'rating' => 'float|max:10',
            'publication_year' => 'nullable|date'
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
