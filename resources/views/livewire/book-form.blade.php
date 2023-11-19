<div class="container mx-auto">
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <input wire:model="title" id="title" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
            <input wire:model="author" id="author" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('author') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="comments" class="block text-sm font-medium leading-6 text-gray-900">Comments</label>
            <textarea wire:model="comments" id="comments" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            @error('comments') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-medium leading-6 text-gray-900">Rating (0-10)</label>
            <input wire:model="rating" id="rating" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="publication_year" class="block text-sm font-medium leading-6 text-gray-900">Publication Year</label>
            <input wire:model="publication_year" id="publication_year" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('publication_year') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <select wire:model="tags" id="tags" multiple class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @foreach($allTags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-md text-white">Submit</button>
        </div>
    </form>
</div>