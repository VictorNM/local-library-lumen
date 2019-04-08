<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 3:21 PM
 */

namespace App\GraphQL\Mutation;

use App\Author;
use Folklore\GraphQL\Support\Mutation;
use GraphQL;
use GraphQL\Type\Definition\Type;

class NewAuthorMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newAuthor'
    ];

    public function type()
    {
        return GraphQL::type('author');
    }

    public function args()
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'family_name' => [
                'name' => 'family_name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'date_of_birth' => [
                'name' => 'date_of_birth',
                'type' => Type::string(),
                'rules' => ['date', 'before_or_equal:today']
            ],
            'date_of_death' => [
                'name' => 'date_of_death',
                'type' => Type::string(),
                'rules' => ['date', 'after_or_equal:date_of_birth', 'before_or_equal:today' ]
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $author = new Author();

        if (isset($args['first_name'])) {
            $author->first_name = $args['first_name'];
        }

        if (isset($args['family_name'])) {
            $author->family_name = $args['family_name'];
        }

        if (isset($args['date_of_birth'])) {
            $author->date_of_birth = $args['date_of_birth'];
        }

        if (isset($args['date_of_death'])) {
            $author->date_of_death = $args['date_of_death'];
        }


        $author->save();
        return $author;
    }
}