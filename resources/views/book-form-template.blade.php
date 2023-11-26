@include('parts/header')
    @isset($bookId)
        @livewire('book-form', ['bookId' => $bookId])
    @else
        @livewire('book-form')
    @endisset
@include('parts/footer')
