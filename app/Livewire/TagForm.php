<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class TagForm extends Component
{
    public $name, $slug, $id;

    public function mount($tagId = null): void
    {
        if(!$tagId){
            return;
        }

        $tag = Tag::findOrFail($tagId);
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        $this->id = $tag->id;
    }

    public function updatedName($value): void
    {
        $this->slug = Str::slug($value);
    }

    public function submit(): void
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        if($this->id){
            $tag = Tag::find($this->id);
            $tag->update($validatedData);
        } else {
            Tag::create($validatedData);
        }

        redirect()->route('tags');
    }

    public function render()
    {
        return view('livewire.tag-form');
    }
}
