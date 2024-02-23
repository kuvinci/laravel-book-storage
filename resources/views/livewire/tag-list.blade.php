<div class="container mx-auto shadow-md p-4 mt-4 bg-white rounded-md">
    @if(count($tags) > 0)
        <ul class="flex flex-wrap">
            @foreach($tags as $tag)
                <li class="flex items-center bg-blue-500 text-white font-bold py-2 px-4 rounded m-2 shadow-lg">
                    <span class="tag-name">{{ $tag->name }}</span>
                    <div>
                        <a href="{{ route('edit-tag', [$tag->id]) }}" class="fas fa-edit cursor-pointer ml-1 p-2 text-white hover:text-yellow-600"></a>
                        <a href="{{ route('delete-tag', [$tag->id]) }}">
                            <i class="fa fa-trash cursor-pointer p-2 text-white hover:text-red-600"></i>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>No tags found</p>
    @endif
</div>
