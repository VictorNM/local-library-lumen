<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 10:25 AM
 */

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Book;


class NewBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newBook'
    ];

    public function type()
    {
        return GraphQL::type('book');
    }

    public function args()
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::nonNull(Type::int()),
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
        $book = new Book();

        $book->title = $args['title'];
        $book->author_id = $args['author_id'];
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