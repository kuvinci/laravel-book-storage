<?php

namespace Tests\Feature\Livewire;

use App\Livewire\BookList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookListTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BookList::class)
            ->assertStatus(200);
    }
}
