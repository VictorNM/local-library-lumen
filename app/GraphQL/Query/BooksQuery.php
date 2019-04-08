<?php
/**
 * Created by PhpStorm.
 * Book: novobi
 * Date: 4/5/2019
 * Time: 9:41 AM
 */

namespace App\GraphQL\Query;

use App\Book;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;


class BooksQuery extends Query
{
    protected $attributes = [
        'name' => 'books'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('book'));
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::int()
            ],
            'isbn' => [
                'name' => 'isbn',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $books = Book::query();

        if (isset($args['id'])) {
            $books->where('id', $args['id']);
        }

        if (isset($args['title'])) {
            $books->where('title', 'like', "%{$args['title']}%");
        }

        // TODO: filter by author name
        if (isset($args['author_id'])) {
            $books->where('author_id', $args['author_id']);
        }

        if (isset($args['isbn'])) {
            $books->where('isbn', 'like', "%{$args['isbn']}%");
        }

        return $books->get();
    }
}