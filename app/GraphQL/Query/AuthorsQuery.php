<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 2:50 PM
 */

namespace App\GraphQL\Query;

use App\Author;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

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
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {

        $authors = Author::query();

        if(isset($args['id'])) {
            $authors->where('id', $args['id']);
        }

        // TODO: modify to search with full name, Vietnamese's name order (example: Nguyen Nhat Anh => currently return null)
        if(isset($args['name'])) {
            $authors->orWhere('first_name', 'like', "%{$args['name']}%");
            $authors->orWhere('family_name', 'like', "%{$args['name']}%");
        }

        // TODO: add filter by date_of_birth, date_of_death, lifespan

        return $authors->get();
    }
}