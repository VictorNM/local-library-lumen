<?php


namespace App\GraphQL\Mutation;

use App\BookInstance;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;

class DeleteBookInstanceMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBookInstance'
    ];

    public function type()
    {
        return Type::int();
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
        return BookInstance::destroy($args['id']) > 0 ? $args['id'] : null;
    }
}