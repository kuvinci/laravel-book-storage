<div class="container mx-auto">

    <ul class="grid grid-cols-3 gap-5">
        @foreach ($books as $book)
            <li class="flex flex-col justify-between shadow-md p-4 bg-white rounded-md">
                <div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-blue-600 mb-2">{{ $book->title }}</h3>
                        <div class="flex">
                            <a href="{{ route('edit-book', ['bookId' => $book->id]) }}" class="fas fa-edit cursor-pointer ml-4 p-1 text-gray-600 hover:text-blue-600"></a>
                            <i
                                wire:click="remove({{ $book->id }})"
                                wire:confirm="Are you sure you want to delete this book?"
                                class="fa fa-trash cursor-pointer p-1 text-gray-600 hover:text-red-600">
                            </i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">
                        <span class="text-sm font-medium text-gray-700">Author: </span>
                        {{ $book->author }}
                    </p>

                    @if($book->comments)
                    <p class="text-sm text-gray-600 mt-1">
                        <span class="text-sm font-medium text-gray-700">Comments: </span>
                        {{ $book->comments }}
                    </p>
                    @endif

                    @if($book->tags)
                    <div class="mt-1">
                        <span class="text-sm font-medium text-gray-700">Tags:</span>
                        @foreach ($book->tags as $tag)
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="flex items-center mt-2">
                    <div id="rating" class="flex">
                        @for ($i = 1; $i <= 10; $i++)
                        <i class="fas fa-star text-xl {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <span class="ml-2 text-l">{{ $book->rating }}/10</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
