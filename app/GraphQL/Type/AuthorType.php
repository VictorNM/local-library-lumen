<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 3:14 PM
 */

namespace App\GraphQL\Type;

use App\Book;
use App\GraphQL\Query\BooksQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AuthorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Author'
    ];

    public function fields()
    {
        return [
            'id' => [
              'name' => 'id',
              'type' => Type::int(),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'books' => [
                'name' => 'books',
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ]
                ],
                'type' => Type::listOf(GraphQL::type('book')),
            ]
        ];
    }

    public function resolveNameField($root)
    {
        return $root->first_name . ' ' . $root->family_name;
    }

    public function resolveBooksField($root, $args)
    {
        $booksQuery = new BooksQuery();
        return $booksQuery->resolve($root, $args);
    }
}