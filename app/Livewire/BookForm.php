<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Livewire\Component;

class BookForm extends Component
{
    public $title, $author, $comments, $rating = 1, $publication_year, $tags = [];

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
