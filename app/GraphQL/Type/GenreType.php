<?php


namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\Genre;

class GenreType extends GraphQLType
{
    protected $attributes = [
        'name' => 'genre'
    ];

    public function fields()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'books' => [
                'name' => 'books',
                'type' => Type::listOf(GraphQL::type('book')),
            ]
        ];
    }
}