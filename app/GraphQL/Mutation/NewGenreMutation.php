<?php


namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Genre;

class NewGenreMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newGenre'
    ];

    public function type()
    {
        return GraphQL::type('genre');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'min:3', 'max:100']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $genre = Genre::create([
            'name' => $args['name']
        ]);
        return $genre;
    }
}