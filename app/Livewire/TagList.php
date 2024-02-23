<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagList extends Component
{
    public function render()
    {
        return view('livewire.tag-list', [
            'tags' => Tag::all()
        ]);
    }
}
