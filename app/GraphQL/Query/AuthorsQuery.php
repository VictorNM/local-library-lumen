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

class AuthorsQuery extends Query
{
    protected $attributes = [
        'name' => 'authors'
    ];

    public function type()
    {
        return Type::string();
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
        return 'You are looking for author: ' . $args['name'];
    }
}