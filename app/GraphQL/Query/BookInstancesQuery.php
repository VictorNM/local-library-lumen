<?php


namespace App\GraphQL\Query;

use App\BookInstance;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class BookInstancesQuery extends Query
{
    protected $attributes = [
        'name' => 'bookInstances'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('bookInstance'));
    }

    public function args()
    {
        return [
            'book_id' => [
                'name' => 'book_id',
                'type' => Type::int()
            ],
            'status' => [
                'name' => 'status',
                'type' => GraphQL::type('bookInstanceStatus')
            ]
        ];
    }

    public function resolve($root, $args)
    {
        // TODO: implement query by range of due_date
        $bookInstances = BookInstance::query();

        if (isset($args['book_id'])) {
            $bookInstances->where('book_id', $args['book_id']);
        }

        if (isset($args['status'])) {
            $bookInstances->where('status', $args['status']);
        }

        return $bookInstances->get();
    }
}