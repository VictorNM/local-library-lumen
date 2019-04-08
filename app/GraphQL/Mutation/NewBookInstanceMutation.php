<?php


namespace App\GraphQL\Mutation;

use App\Book;
use GraphQL;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use App\BookInstance;
use http\Exception\InvalidArgumentException;


class NewBookInstanceMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newBookInstance'
    ];

    public function type()
    {
        return GraphQL::type('bookInstance');
    }

    public function args()
    {
        return [
            'book_id' => [
                'name' => 'book_id',
                'type' => Type::nonNull(Type::int())
            ],
            'status' => [
                'name' => 'status',
                'type' => GraphQL::type('bookInstanceStatus')
            ],
            'due_back' => [
                'name' => 'due_back',
                'type' => Type::string(),
                'rules' => ['date']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (!Book::find($args['book_id'])) {
            throw new \InvalidArgumentException("Book instance must belong to 1 Book");
        }

        $bookInstance = new BookInstance();
        $bookInstance->book_id = $args['book_id'];

        if (isset($args['status'])) {
            $bookInstance->status = $args['status'];
        }

        if (isset($args['due_back'])) {
            $bookInstance->due_back = $args['due_back'];
        }

        $bookInstance->save();

        // TODO: currently , this function return $bookInstance without default value generated by DBMS, fix it

        return $bookInstance;
    }
}