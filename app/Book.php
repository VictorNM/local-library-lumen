<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author_id', 'summary', 'isbn'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function bookInstances()
    {
        return $this->hasMany(BookInstance::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
