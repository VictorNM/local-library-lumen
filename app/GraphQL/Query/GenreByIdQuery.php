<?php


namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Genre;

class GenreByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'name'
    ];

    public function type()
    {
        return GraphQL::type('genre');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $genre = Genre::find($args['id']);
        if (!$genre) {
            throw new \InvalidArgumentException("Genre not found");
        }
        return $genre;
    }
}