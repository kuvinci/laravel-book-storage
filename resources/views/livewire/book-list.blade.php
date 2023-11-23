<div class="container mx-auto">
    <ul class="divide-y divide-gray-200">
        @foreach ($books as $book)
            <li class="p-4 hover:bg-gray-50">
                <h3 class="text-lg font-semibold text-blue-600">{{ $book->title }}</h3>
                <p class="text-sm text-gray-600">
                    <span class="text-sm font-medium text-gray-700">Author: </span>
                    {{ $book->author }}
                </p>

                <div class="flex">
                    <div id="rating" class="flex">
                        @for ($i = 1; $i <= 10; $i++)
                            <i class="fas fa-star text-xl {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <span class="ml-2 text-xl">{{ $book->rating }}/10</span>
                </div>

                @if($book->tags)
                    <div class="mt-2">
                        <span class="text-sm font-medium text-gray-700">Tags:</span>
                        @foreach ($book->tags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                @if($book->comments)
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="text-sm font-medium text-gray-700">Comments: </span>
                        {{ $book->comments }}
                    </p>
                @endif
            </li>
        @endforeach
    </ul>
</div>
