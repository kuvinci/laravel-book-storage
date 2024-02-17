<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Tag;
use App\Providers\GoogleSearchServiceProvider;
use App\Models\Options;
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
    public $comments;
    public $rating = 1;
    public $publication_year;
    public $tags = [];
    public $isEditing = false;
    public $apiLimit;

    public function mount($bookId = null): void
    {
        if ($bookId) {
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
        } else {
            $this->apiLimit = config('options.counter');
        }
    }

    public function toggleTag($tagId): void
    {
        if (in_array($tagId, $this->tags)) {
            $this->tags = array_diff($this->tags, [$tagId]);
        } else {
            $this->tags[] = $tagId;
        }
    }

    public function submit(): void
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'comments' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:10',
            'publication_year' => 'nullable|numeric|digits:4|between:1900,'.Carbon::now()->year,
            'cover_image_file' => 'nullable|image|max:1024',
        ]);

        if ($this->isEditing) {
            $this->editBook($validatedData);
        } else {
            $this->createBook($validatedData);
        }

        $this->redirect('/');
    }

    private function editBook($validatedData): void
    {
        $validatedData = $this->handleBookCover($validatedData);

        $book = Book::find($this->book_id);
        $book->update($validatedData);
        $book->tags()->sync($this->tags);

        $this->dispatch('flash-message', ['message' => 'Book successfully edited.']);
    }

    private function createBook($validatedData): void
    {
        $validatedData = $this->handleBookCover($validatedData);

        $book = Book::create($validatedData);
        $book->tags()->attach($this->tags);

        $this->dispatch('flash-message', ['message' => 'Book successfully created.']);
    }

    /**
     * Handle the book cover image and update the validated data accordingly.
     *
     * @param  array  $validatedData  The validated data of the book.
     * @return array The updated validated data with the cover image URL.
     */
    private function handleBookCover(array $validatedData): array
    {
        if (is_null($this->cover_image_file) && is_null($this->suggested_cover_image)) {
            $validatedData['cover_image'] = $this->cover_image;
            return $validatedData;
        }
        $imageFileObj = $this->suggested_cover_image ? $this->convertBookCoverUrlToFile() : $this->cover_image_file;

        $validatedData['cover_image'] = $this->saveAndGetS3URL($imageFileObj);
        return $validatedData;
    }

    /**
     * Saves the given image file object to AWS S3 and returns the URL to the saved image.
     *
     * @param $imageFileObj - The image file object to be saved to S3.
     *
     * @return string The URL of the saved image in AWS S3.
     */
    private function saveAndGetS3URL($imageFileObj): string
    {
        $imageName = time().'_'.$imageFileObj->getClientOriginalName();
        Storage::disk('s3')->put('book_covers/'.$imageName, file_get_contents($imageFileObj->getRealPath()));
        return Storage::disk('s3')->url('book_covers/'.$imageName);
    }

    /**
     * Calls the Google Search API to suggest book covers based on the title of the book and updates the book_covers property.
     *
     * @return void
     */
    public function suggestBookCovers(): void
    {
        if($this->book_covers){
            $this->dispatch('flash-message', ['message' => 'Please choose the book cover from already suggested.']);
            return;
        }

        $apiLimitCounter = intval(config('options.counter'));
        if($apiLimitCounter >= 100){
            $this->dispatch('flash-message', ['message' => 'Unfortunately the daily API limit reached.']);
            return;
        }

        $googleSearchService = new GoogleSearchServiceProvider();
        $searchResult = $googleSearchService->search($this->title, " book cover");
        $this->book_covers = array_column($searchResult, 'link');

        Options::setOption('counter', ++$apiLimitCounter);
    }

    public function saveSuggestedBookCover(string $imageURL): void
    {
        $this->suggested_cover_image = $imageURL;
    }

    /**
     * @return UploadedFile The UploadedFile object representing the temporary book cover file.
     */
    private function convertBookCoverUrlToFile(): UploadedFile
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
