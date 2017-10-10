<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Controller;

use Fesor\FractalBundle\FractalTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tests\Fesor\FractalBundle\Functional\Example\Model\Book;
use Tests\Fesor\FractalBundle\Functional\Example\Transformer\BookTransformer;

class BookController extends Controller
{
    use FractalTrait;

    public function getBookDetails(string $id)
    {
        $book = new Book($id, 'Example Book', 'author-1');

        return $this->item($book, new BookTransformer())->asJsonResponse();
    }
}