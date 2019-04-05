<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 3:21 PM
 */

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Author;

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
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $author = new Author();
        $author->first_name = $args['first_name'];
        $author->family_name = $args['family_name'];

        $author->save();
        return $author;
    }
}