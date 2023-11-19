<div class="container mx-auto">
    <ul class="divide-y divide-gray-200">
        @foreach ($books as $book)
            <li class="p-4 hover:bg-gray-50">
                <h3 class="text-lg font-semibold text-blue-600">{{ $book->title }}</h3>
                <p class="text-sm text-gray-600">Author: {{ $book->author }}</p>
                <div class="mt-2">
                    <span class="text-sm font-medium text-gray-700">Tags:</span>
                    @foreach ($book->tags as $tag)
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
</div>
