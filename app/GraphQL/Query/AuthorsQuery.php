<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 2:50 PM
 */

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Author;

class AuthorsQuery extends Query
{
    protected $attributes = [
        'name' => 'authors'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('author'));
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Author::all();
    }
}