<?php


namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\BookInstance;

class BookInstanceByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'bookInstance'
    ];

    public function type()
    {
        return GraphQL::type('bookInstance');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $bookInstance = BookInstance::find($args['id']);
        if (!$bookInstance) {
            throw new \InvalidArgumentException("BookInstance not found");
        }
        return $bookInstance;
    }
}