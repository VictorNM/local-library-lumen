<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Genre;

class UpdateGenreMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateGenre'
    ];

    public function type()
    {
        return GraphQL::type('genre');
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['min:3', 'max:100'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $genre = Genre::find($args['id']);
        if (!$genre) {
            throw new \InvalidArgumentException("Genre not found");
        }
        if (isset($args['name']) && strlen($args['name']) > 0) {
            $genre->name = $args['name'];
        }
        $genre->save();
        return $genre;
    }
}