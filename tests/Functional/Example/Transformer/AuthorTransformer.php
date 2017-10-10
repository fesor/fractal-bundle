<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Transformer;

use Fesor\FractalBundle\Transformer;
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
