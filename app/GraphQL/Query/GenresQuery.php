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

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $genres = Genre::query();
        if (isset($args['name'])) {
            $genres->where('name', 'like', "%{$args['name']}%");
        }

        return $genres->get();
    }
}