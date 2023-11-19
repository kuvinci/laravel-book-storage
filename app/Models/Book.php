<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'comments', 'rating', 'publication_year'];

    public function create($validatedData)
    {
        dd($validatedData);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
