<?php


namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use App\Genre;

class DeleteGenreMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteGenre'
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
        return Genre::destroy($args['id']) > 0 ? 'Delete successfully' : 'Nothing has been deleted';
    }
}