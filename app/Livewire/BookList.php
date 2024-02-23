<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class BookList extends Component
{
    use WithPagination;

    public $bookIDs;
    public $search;
    public $tags;
    public $tag;

    public function remove($bookId): void
    {
        if (!$bookId) {
            return;
        }

        Book::destroy($bookId);

        // Reset books list
        $this->fetchData();
        $this->dispatch('flash-message', ['message' => 'Book successfully deleted.']);
    }

    public function mount(): void
    {
        $this->tags = Tag::all();
        $this->fetchData();
    }

    public function updatedSearch(): void
    {
        if(empty($this->search)){
            $this->fetchData();
            return;
        }

        $this->books = Book::where('title', 'like', '%'.$this->search.'%')
            ->orWhere('author', 'like', '%'.$this->search.'%')
            ->orWhere('publication_year', 'like', '%'.$this->search.'%')
            ->get()
            ->reverse();
    }

    public function updatedTag(): void
    {
        $this->resetPage();
        $this->fetchData();
    }

    private function fetchData(): void
    {
        $query = Book::with('tags');

        if ($this->tag) {
            $query->whereHas('tags', function ($query) {
                $query->where('name', $this->tag);
            });
        }

        $this->bookIDs = $query->get()->pluck('id')->reverse()->toArray();
    }

    private function prepareBooks()
    {
        return Book::with('tags')
            ->whereIn('id', $this->bookIDs)
            ->orderBy('id','desc')
            ->paginate(12);
    }

    public function render()
    {
        $books = $this->prepareBooks();
        return view('livewire.book-list', [
            'books' => $books
        ]);
    }
}
