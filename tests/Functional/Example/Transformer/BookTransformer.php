<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Transformer;

use Fesor\FractalBundle\Fractal\Transformer;
use Tests\Fesor\FractalBundle\Functional\Example\Model\Book;

class BookTransformer extends Transformer
{
    protected $availableIncludes = ['author', 'reviews'];
    protected $defaultIncludes = ['author'];

    public function transform(Book $book)
    {
        return [
            'id' => $book->getId(),
            'name' => $book->getName(),
        ];
    }

    public function includeAuthor(Book $book)
    {
        $authorId = $book->getAuthor();

        return $this->primitive([
            'id' => $authorId,
        ]);
    }

    public function includeReviews()
    {
        return $this->collection([], function ($data) {
            return $data;
        });
    }
}
