<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 3:14 PM
 */

namespace App\GraphQL\Type;

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
                'type' => Type::string()
            ]
        ];
    }

    public function resolveNameField($root)
    {
        return $root->first_name . ' ' . $root->family_name;
    }
}