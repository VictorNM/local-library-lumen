<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 3:09 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'family_name', 'date_of_birth', 'date_of_death'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}