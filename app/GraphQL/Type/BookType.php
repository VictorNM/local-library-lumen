<?php

namespace App\GraphQL\Type;

use App\GraphQL\Query\BookInstancesQuery;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\Type;

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
                'type' => GraphQL::type('author'),
            ],
            'summary' => [
                'type' => Type::string(),
            ],
            'isbn' => [
                'type' => Type::string(),
            ],
            'bookInstances' => [
                'type' => Type::listOf(GraphQL::type('bookInstance')),
                'args' => [
                    'status' => [
                        'name' => 'status',
                        'type' => GraphQL::type('bookInstanceStatus')
                    ]
                ]
            ],
            'genres' => [
                'type' => Type::listOf(GraphQL::type('genre'))
            ],
            'created_at' => [
                'type' => Type::string(),
            ],
            'updated_at' => [
                'type' => Type::string(),
            ],
        ];
    }

    protected function resolveBookInstancesField($root, $args) {
        $bookInstanceQuery = new BookInstancesQuery();
        $args['book_id'] = $root->id;
        return $bookInstanceQuery->resolve(null, $args);
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }
}