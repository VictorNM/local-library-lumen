<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BookType extends GraphQLType
{
    protected $attribute = [
        'name' => 'book',
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'author' => [
                'type' => Type::nonNull(GraphQL::type('author')),
            ],
            'summary' => [
                'type' => Type::string(),
            ],
            'isbn' => [
                'type' => Type::string(),
            ]
        ];
    }
}