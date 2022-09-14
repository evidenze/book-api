<?php

namespace App\Models;

use Database\Factories\ApiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'isbn', 'release_date', 'country', 'number_of_pages', 'publisher',
    ];

    protected $table = 'books';

    protected $casts = [
        'authors' => 'array'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ApiFactory::new();
    }
}
