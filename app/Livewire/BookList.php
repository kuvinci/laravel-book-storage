<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookList extends Component
{
    public $books;

    public function remove($bookId)
    {
        if($bookId){
            Book::destroy($bookId);

            // Reset books list
            $this->fetchData();
            $this->dispatch('flash-message', ['message' => 'Book successfully deleted.']);
        }
    }

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $this->books = Book::with('tags')->get();
    }

    public function render()
    {
        return view('livewire.book-list');
    }
}
