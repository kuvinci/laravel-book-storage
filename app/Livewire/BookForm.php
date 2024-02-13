<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use App\Providers\GoogleSearchServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BookForm extends Component
{
    use WithFileUploads;

    public $book_id;
    public $title;
    public $author;
    public $cover_image;
    public $cover_image_file;
    public $suggested_cover_image;
    public $book_covers;
    public $test_cover = "https://m.media-amazon.com/images/I/81tBoQP5V+L._AC_UF1000,1000_QL80_.jpg";
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
        if(is_null($this->cover_image_file) && is_null($this->suggested_cover_image)){
            $validatedData['cover_image'] = $this->cover_image;
            return $validatedData;
        }
        $imageFileObj = $this->suggested_cover_image ? $this->convertBookCoverUrlToFile() : $this->cover_image_file;

        $validatedData['cover_image'] = $this->saveAndGetS3URL($imageFileObj);
        return $validatedData;
    }

    private function saveAndGetS3URL($imageFileObj) : string
    {
        $imageName = time().'_'.$imageFileObj->getClientOriginalName();
        Storage::disk('s3')->put('book_covers/'.$imageName, file_get_contents($imageFileObj->getRealPath()));
        return Storage::disk('s3')->url('book_covers/'.$imageName);
    }

    public function suggestBookCovers()
    {
        $googleSearchService = new GoogleSearchServiceProvider();
        $searchResult = $googleSearchService->search($this->title);

        $this->book_covers = $this->formatBookCoversList($searchResult['items']);
    }

    private function formatBookCoversList(array $searchItems) : array
    {
        return array_column($searchItems, 'link');
    }

    public function saveSuggestedBookCover($imageURL)
    {
        $this->suggested_cover_image = $imageURL;
    }

    private function convertBookCoverUrlToFile() : UploadedFile
    {
        $data = file_get_contents($this->suggested_cover_image);
        $tempPath = tempnam(sys_get_temp_dir(), 'image');
        file_put_contents($tempPath, $data);

        return new UploadedFile($tempPath, 'temporary_book_cover.jpg', 'image/jpeg', null, true);
    }

    public function render()
    {
        return view('livewire.book-form', [
            'allTags' => Tag::all()
        ]);
    }
}
