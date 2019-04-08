<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 3:14 PM
 */

namespace App\GraphQL\Type;

use App\GraphQL\Query\BooksQuery;
use Carbon\Carbon;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\Type;

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
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::string(),
            ],
            'family_name' => [
                'name' => 'first_name',
                'type' => Type::string(),
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
            ],
            'date_of_birth' => [
                'name' => 'date_of_birth',
                'type' => Type::string(),
            ],
            'date_of_death' => [
                'name' => 'date_of_death',
                'type' => Type::string(),
            ],
            'lifespan' => [
                'name' => 'lifespan',
                'type' => Type::int(),
            ],
            'created_at' => [
                'type' => Type::string(),
            ],
            'updated_at' => [
                'type' => Type::string(),
            ],
        ];
    }

    protected function resolveNameField($root)
    {
        return $root->first_name . ' ' . $root->family_name;
    }

    protected function resolveBooksField($root, $args)
    {
        $booksQuery = new BooksQuery();
        $args['author_id'] = $root->id;
        return $booksQuery->resolve(null, $args, null, null);
    }

    protected function resolveLifespanField($root, $args)
    {
        $date_of_birth = Carbon::createFromFormat('Y-m-d', $root->date_of_birth);
        $date_of_death = Carbon::createFromFormat('Y-m-d', $root->date_of_death);

        if ($date_of_birth->year < 1) {
            return null;
        }

        if ($date_of_death->year < 1) {
            return Carbon::now()->diffInYears($date_of_birth);
        }

        return $date_of_death->diffInYears($date_of_birth);
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return $root->created_at->toDateTimeString();
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string)$root->updated_at;
    }
}