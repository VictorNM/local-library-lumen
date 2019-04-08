<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 11:14 AM
 */

namespace App\GraphQL\Mutation;

use App\Author;
use App\Book;
use App\Genre;
use Folklore\GraphQL\Support\Mutation;
use GraphQL;
use GraphQL\Type\Definition\Type;

class UpdateBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateBook'
    ];

    public function type()
    {
        return GraphQL::type('book');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::int(),
            ],
            'summary' => [
                'name' => 'summary',
                'type' => Type::string(),
            ],
            'isbn' => [
                'name' => 'isbn',
                'type' => Type::string(),
            ],
            'genre_ids' => [
                'name' => 'genre_ids',
                'type' => Type::listOf(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $book = Book::find($args['id']);

        if (!$book) {
            throw new \InvalidArgumentException("Book not found");
        }

        if (isset($args['title'])) {
            $book->title = $args['title'];
        }

        if (isset($args['author_id'])) {
            if (!Author::find($args['author_id'])) {
                throw new \InvalidArgumentException("Author not existed.");
            }
            $book->author_id = $args['author_id'];
        }

        if (isset($args['summary'])) {
            $book->summary = $args['summary'];
        }

        if (isset($args['isbn'])) {
            $book->isbn = $args['isbn'];
        }

        if (isset($args['genre_ids'])) {
            $genres = Genre::find($args['genre_ids']);
            if (sizeof($genres) != sizeof($args['genre_ids'])) {
                throw new \InvalidArgumentException("Genres not found");
            }
        }

        $book->save();

        if (isset($args['genre_ids'])) {
            $book->genres()->sync($args['genre_ids']);
        }

        return $book;
    }
}