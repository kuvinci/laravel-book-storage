<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'cover_image', 'comments', 'rating', 'publication_year'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
