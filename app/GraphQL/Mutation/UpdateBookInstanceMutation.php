<?php


namespace App\GraphQL\Mutation;

use App\Book;
use Folklore\GraphQL\Support\Mutation;
use GraphQL;
use GraphQL\Type\Definition\Type;
use App\BookInstance;

class UpdateBookInstanceMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateBookInstance'
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
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'book_id' => [
                'name' => 'book_id',
                'type' => Type::int(),
            ],
            'status' => [
                'name' => 'status',
                'type' => GraphQL::type('bookInstanceStatus'),
            ],
            'due_back' => [
                'name' => 'due_back',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $bookInstance = BookInstance::find($args['id']);

        if (!$bookInstance) {
            throw new \InvalidArgumentException("BookInstance not found");
        }

        if (isset($args['book_id'])) {
            if (!Book::find($args['book_id'])) {
                throw new \InvalidArgumentException("BookInstance must belong to 1 Book");
            }
            $bookInstance->book_id = $args['id'];
        }

        if (isset($args['status'])) {
            $bookInstance->status = $args['status'];
        }

        if (isset($args['due_back'])) {
            $bookInstance->due_back = $args['due_back'];
        }

        $bookInstance->save();
        return $bookInstance;
    }
}