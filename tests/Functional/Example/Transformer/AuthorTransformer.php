<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Transformer;

use Fesor\FractalBundle\Fractal\Transformer;
use Tests\Fesor\FractalBundle\Functional\Example\Model\Author;

class AuthorTransformer extends Transformer
{
    public function transformer(Author $author)
    {
        return [
            'id' => $author->getId(),
            'name' => $author->getName(),
        ];
    }
}
