<?php


namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;


class BookInstanceStatusType extends GraphQLType
{
    protected $enumObject = true;

    protected $attributes = [
        'name' => 'bookInstanceStatus',
        'values' => [
            'Available',
            'Maintenance',
            'Loaned',
            'Reserved'
        ]
    ];
}