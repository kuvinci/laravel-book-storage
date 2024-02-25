<?php

namespace Tests\Unit;

use App\Livewire\BookForm;
use App\Models\Book;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookFormTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function can_add_book_trough_form(): void
    {
        $title = $this->faker->text(20);

        Livewire::test(BookForm::class)
            ->set('title', $title)
            ->set('author', $this->faker->name())
            ->set('comments', $this->faker->text(255))
            ->set('rating', $this->faker->numberBetween(1, 10))
            ->set('publication_year', $this->faker->numberBetween(1900, Carbon::now()->year))
            ->call('submit')
            ->assertRedirect(route('home-page'));

        $this->assertTrue(Book::where('title', $title)->exists());

        Book::where('title', $title)->delete();
    }
}
