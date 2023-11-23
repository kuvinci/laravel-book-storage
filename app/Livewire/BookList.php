<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookList extends Component
{
    public $books;

    public function mount()
    {
        $this->books = Book::with('tags')->get();
    }

    public function render()
    {
        return view('livewire.book-list');
    }
}
