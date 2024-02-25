<?php

namespace Tests\Unit;

use App\Livewire\TagForm;
use App\Models\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class TagFormTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function can_add_tag_through_form()
    {
        $name = $this->faker->word();

        Livewire::test(TagForm::class)
            ->set('name', $name)
            ->set('slug', Str::slug($name))
            ->call('submit')
            ->assertRedirect(route('tags'));

        $this->assertTrue(Tag::where('name', $name)->exists());

        Tag::where('name', $name)->delete();
    }
}
