<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class BookInstance extends Model
{
    protected $fillable = [
        'book_id', 'status', 'due_back'
    ];
}