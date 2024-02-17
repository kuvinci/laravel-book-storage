<div class="container mx-auto">
    <form wire:submit.prevent="submit" class="space-y-4 shadow-md p-4 bg-white rounded-md">
        <div>
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <input wire:model="title" id="title" type="text" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
            <input wire:model="author" id="author" type="text" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('author') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="comments" class="block text-sm font-medium leading-6 text-gray-900">Comments</label>
            <textarea wire:model="comments" id="comments" type="text" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            @error('comments') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
            <div class="flex">
                <div id="rating" class="flex">
                    @for ($i = 1; $i <= 10; $i++)
                        <i wire:click="$set('rating', {{ $i }})" class="fas fa-star cursor-pointer text-2xl {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    @endfor
                </div>
                <span class="ml-2 text-2xl">{{ $rating }}/10</span>
            </div>
            @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="publication_year" class="block text-sm font-medium leading-6 text-gray-900">Publication Year</label>
            <input wire:model="publication_year" id="publication_year" type="text" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('publication_year') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
            @foreach ($allTags as $tag)
                <span
                    wire:click="toggleTag({{ $tag->id }})"
                    class="cursor-pointer inline-block bg-gray-200 hover:bg-yellow-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 {{ in_array($tag->id, $tags) ? 'bg-yellow-400' : '' }}"
                >
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        <div>
            @if ($cover_image_file)
                <img src="{{ $cover_image_file->temporaryUrl() }}" class="w-24 py-1.5">
            @elseif ($cover_image)
                <img src="{{ $cover_image }}" class="w-24 py-1.5">
            @elseif ($suggested_cover_image)
                <img src="{{ $suggested_cover_image }}" class="w-24 py-1.5">
            @endif
            <label for="cover_image_file" class="block text-sm font-medium leading-6 text-gray-900">Book Cover</label>
            <input wire:model="cover_image_file" type="file" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('cover_image_file') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col items-start">
            <button wire:click="suggestBookCovers" type="button" class="px-4 py-2 mb-2 bg-blue-500 hover:bg-blue-700 rounded-md text-white">Suggest Book Cover</button>
            <span class="text-xs italic"><span class="text-red-600">*</span> Today's suggestions limit {{$apiLimit}}/100</span>
        </div>

        @if ($book_covers && !$suggested_cover_image)
            <div class="grid grid-cols-4 gap-4">
                @foreach ($book_covers as $cover)
                    <img wire:click="saveSuggestedBookCover('{{ $cover }}')" src="{{ $cover }}" alt="Book Cover" class="w-full h-auto cursor-pointer">
                @endforeach
            </div>
        @endif

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-md text-white">Submit</button>
        </div>
    </form>
</div>
