<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 5:30 PM
 */

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Author;

// TODO: (for all mutations: find the way to delete value of null-alble fields)

class UpdateAuthorMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateAuthor'
    ];

    public function type()
    {
        return GraphQL::type('author');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::string(),
            ],
            'family_name' => [
                'name' => 'family_name',
                'type' => Type::string(),
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
        $author = Author::find($args['id']);

        if (!$author) {
            return null;
        }

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