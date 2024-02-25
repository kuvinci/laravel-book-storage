<?php

namespace Tests\Feature\Livewire;

use App\Livewire\BookForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BookForm::class)
            ->assertStatus(200);
    }
}
