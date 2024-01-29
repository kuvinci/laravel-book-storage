<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Livewire\Component;

class BookList extends Component
{
    public $books;

    public $search = '';
    public $tags;
    public $tag;

    public function remove($bookId)
    {
        if ($bookId) {
            Book::destroy($bookId);

            // Reset books list
            $this->fetchData();
            $this->dispatch('flash-message', ['message' => 'Book successfully deleted.']);
        }
    }

    public function mount()
    {
        $this->tags = Tag::all();
        $this->fetchData();
    }

    public function updatedSearch()
    {
        if ($this->search != '') {
            $this->books = Book::where('title', 'like', '%'.$this->search.'%')
                ->orWhere('author', 'like', '%'.$this->search.'%')
                ->orWhere('publication_year', 'like', '%'.$this->search.'%')
                ->get();
        }
        else {
            $this->fetchData();
        }
    }

    public function updatedTag()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $query = Book::with('tags');

        if ($this->tag) {
            $query->whereHas('tags', function ($query) {
                $query->where('name', $this->tag);
            });
        }

        $this->books = $query->get();
    }

    public function render()
    {
        return view('livewire.book-list');
    }
}
