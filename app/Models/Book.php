<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'pages',
        'published_at',
        'cover',
        'description',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BookCategory::class, 'book_category', 'book_id', 'category_id');
    }
}
