<?php
/**
 * Created by PhpStorm.
 * Book: novobi
 * Date: 4/5/2019
 * Time: 9:41 AM
 */

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Book;
use Illuminate\Support\Facades\DB;


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
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $books = DB::table('books');

        if (isset($args['id'])) {
            $books->where('id', $args['id']);
        }

        if (isset($args['title'])) {
            $keyword = $args['title'];
            $books->where('title', 'like', "%{$keyword}%");
        }

        if (isset($args['author_id'])) {
            $books->where('author_id', $args['author_id']);
        }

        return $books->get();
    }
}