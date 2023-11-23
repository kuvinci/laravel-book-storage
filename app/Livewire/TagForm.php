<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class TagForm extends Component
{
    public $name, $slug;

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        Tag::create($validatedData);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.tag-form');
    }
}
