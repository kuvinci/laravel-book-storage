<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BookForm extends Component
{
    use WithFileUploads;

    public $book_id;
    public $title;
    public $author;
    public $cover_image;
    public $cover_image_file;
    public $comments;
    public $rating = 1;
    public $publication_year;
    public $tags = [];
    public $isEditing = false;

    public function mount($bookId = null)
    {
        if($bookId){
            $book = Book::findOrFail($bookId);
            $this->book_id = $book->id;
            $this->title = $book->title;
            $this->author = $book->author;
            $this->cover_image = $book->cover_image;
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
            'publication_year' => 'nullable|numeric|digits:4|between:1900,'.Carbon::now()->year,
            'cover_image_file' => 'nullable|image|max:1024',
        ]);

        if($this->isEditing){
            $validatedData = $this->handleBookCover($validatedData);

            $book = Book::find($this->book_id);
            $book->update($validatedData);
            $book->tags()->sync($this->tags);

            $this->dispatch('flash-message', ['message' => 'Book successfully edited.']);
        } else {
            $validatedData = $this->handleBookCover($validatedData);

            $book = Book::create($validatedData);
            $book->tags()->attach($this->tags);
        }

        $this->redirect('/');
    }

    /**
     * Handle the book cover image and update the validated data accordingly.
     *
     * @param  array  $validatedData  The validated data of the book.
     * @return array The updated validated data with the cover image URL.
     */
    private function handleBookCover(array $validatedData) : array {
        if(is_null($this->cover_image_file)){
            $validatedData['cover_image'] = $this->cover_image;
            return $validatedData;
        }

        $imageName = time().'_'.$this->cover_image_file->getClientOriginalName();

        $this->cover_image_file->storeAs('book_covers', $imageName, 's3');
        $s3Url = Storage::disk('s3')->url('book_covers/'.$imageName);

        $validatedData['cover_image'] = $s3Url;
        return $validatedData;
    }

    public function render()
    {
        return view('livewire.book-form', [
            'allTags' => Tag::all()
        ]);
    }
}
