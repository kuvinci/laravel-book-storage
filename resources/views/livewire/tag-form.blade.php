<div class="container mx-auto shadow-md p-4 bg-white rounded-md">
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Add Category (Tag)</label>
            <input wire:model="name" id="name" type="text" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-md text-white">Submit</button>
        </div>
    </form>
</div>
