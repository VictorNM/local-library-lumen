<?php


namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\Type;

class BookInstanceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'bookInstance'
    ];

    public function fields()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'book' => [
                'name' => 'book',
                'type' => GraphQL::type('book')
            ],
            'status' => [
                'name' => 'status',
                'type' => GraphQL::type('bookInstanceStatus')
            ],
            'due_back' => [
                'name' => 'due_back',
                'type' => Type::string(),
            ],
            'created_at' => [
                'name' => 'created_at',
                'type' => Type::string()
            ],
            'updated_at' => [
                'name' => 'updated_at',
                'type' => Type::string()
            ]
        ];
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