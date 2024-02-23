<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TagList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TagListTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TagList::class)
            ->assertStatus(200);
    }
}
