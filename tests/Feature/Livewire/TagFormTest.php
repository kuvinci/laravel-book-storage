<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TagForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TagFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TagForm::class)
            ->assertStatus(200);
    }
}
