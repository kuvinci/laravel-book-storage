@include('parts/header')
    @if(isset($tagId))
        @livewire('tag-form', ['tagId' => $tagId])
    @else
        @livewire('tag-form')
    @endif
    @livewire('tag-list')
@include('parts/footer')
