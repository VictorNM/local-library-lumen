<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 11:31 AM
 */

namespace App\GraphQL\Mutation;

use App\Book;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;

class DeleteBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBook'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Book::destroy($args['id']) > 0 ? 'Delete successfully' : 'Nothing has been deleted';
    }
}