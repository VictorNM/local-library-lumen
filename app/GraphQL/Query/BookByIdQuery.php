<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 1:42 PM
 */

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Book;

class BookByIdQuery extends Query
{
    protected $attribute = [
        'name' => 'book'
    ];

    public function type()
    {
        return GraphQL::type('book');
    }

    public function args()
    {
        return [
            'id' => Type::int()
        ];
    }

    public function resolve($root, $args)
    {
        $book = Book::find($args['id']);
        return $book;
    }
}