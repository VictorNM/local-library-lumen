<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 11:14 AM
 */

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Book;

class UpdateBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateBook'
    ];

    public function type()
    {
        return GraphQL::type('book');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::int(),
            ],
            'summary' => [
                'name' => 'summary',
                'type' => Type::string(),
            ],
            'isbn' => [
                'name' => 'isbn',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $book = Book::find($args['id']);

        if (!$book) {
            return null;
        }

        if (isset($args['title'])) {
            $book->title = $args['title'];
        }

        if (isset($args['author_id'])) {
            $book->author_id = $args['author_id'];
        }

        if (isset($args['summary'])) {
            $book->summary = $args['summary'];
        }

        if (isset($args['isbn'])) {
            $book->isbn = $args['isbn'];
        }

        $book->save();
        return $book;
    }
}