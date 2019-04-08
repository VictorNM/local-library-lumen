<?php


namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\BookInstance;

class DeleteBookInstanceMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBookInstance'
    ];

    public function type()
    {
        return Type::string();
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
        return BookInstance::destroy($args['id']) > 0 ? "Delete successfully" : "Nothing has been deleted";
    }
}