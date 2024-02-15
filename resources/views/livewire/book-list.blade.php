<div class="container mx-auto">
    <div class="w-full flex justify-center py-5">
        <div class="bg-white w-full flex items-center rounded-full shadow-lg">
            <input class="rounded-l-full w-full py-4 px-9 text-gray-700 leading-tight outline-none" id="search" type="text" wire:model.live.debounce.500ms="search" placeholder="Search">

            <div class="p-4">
                <button class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-12 h-12 flex items-center justify-center">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-full flex justify-center mb-5 flex-wrap">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2 shadow-lg"
            wire:click="$set('tag', '')"
        >
            All
        </button>

        @foreach($tags as $tag)
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2 shadow-lg"
                wire:click="$set('tag', '{{ $tag->name }}')"
            >
                {{ $tag->name }}
            </button>
        @endforeach
    </div>

    <ul class="grid grid-cols-2 gap-5">
        @foreach ($books as $book)
            <li class="flex flex shadow-md p-4 bg-white rounded-md">
                <div>
                    <img src="{{ $book->cover_image }}" class="pr-4 max-w-60" alt="Book Cover">
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-blue-600 mb-2">{{ $book->title }}</h3>
                        <div class="flex">
                            <a href="{{ route('edit-book', ['bookId' => $book->id]) }}" class="fas fa-edit cursor-pointer ml-4 mb-2 p-2 text-gray-600 hover:text-blue-600"></a>
                            <i
                                wire:click="remove({{ $book->id }})"
                                wire:confirm="Are you sure you want to delete this book?"
                                class="fa fa-trash cursor-pointer p-2 mb-2 text-gray-600 hover:text-red-600">
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

                    <div class="flex items-center mt-2">
                        <div id="rating" class="flex">
                            @for ($i = 1; $i <= 10; $i++)
                            <i class="fas fa-star text-xl {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                        <span class="ml-2 text-l">{{ $book->rating }}/10</span>
                    </div>
                </div>

            </li>
        @endforeach
    </ul>
</div>
