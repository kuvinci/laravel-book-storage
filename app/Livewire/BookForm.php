<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Livewire\Component;

class BookForm extends Component
{
    public $book_id, $title, $author, $comments, $rating = 1, $publication_year, $tags = [];
    public $isEditing = false;

    public function mount($bookId = null)
    {
        if($bookId){
            $book = Book::findOrFail($bookId);
            $this->book_id = $book->id;
            $this->title = $book->title;
            $this->author = $book->author;
            $this->comments = $book->comments;
            $this->rating = $book->rating;
            $this->publication_year = $book->publication_year;
            $this->tags = $book->tags->pluck('id')->toArray();
            $this->isEditing = true;
        }
    }

    public function toggleTag($tagId)
    {
        if (in_array($tagId, $this->tags)) {
            $this->tags = array_diff($this->tags, [$tagId]);
        } else {
            $this->tags[] = $tagId;
        }
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'comments' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:10',
            'publication_year' => 'nullable|numeric|digits:4|between:1900,'.Carbon::now()->year
        ]);

        if($this->isEditing){
            $book = Book::find($this->book_id);
            $book->update($validatedData);
            $book->tags()->sync($this->tags);

            $this->dispatch('flash-message', ['message' => 'Book successfully edited.']);
        } else {
            $book = Book::create($validatedData);
            $book->tags()->attach($this->tags);

            $this->redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.book-form', [
            'allTags' => Tag::all()
        ]);
    }
}
