<?php


namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Genre;

class GenresQuery extends Query
{
    protected $attributes = [
        'name' => 'genres'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('genre'));
    }

    public function resolve($root, $args)
    {
        return Genre::all();
    }
}