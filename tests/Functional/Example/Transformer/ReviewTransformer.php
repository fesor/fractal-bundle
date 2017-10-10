<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Transformer;

use Fesor\FractalBundle\Transformer;
use Tests\Fesor\FractalBundle\Functional\Example\Model\Review;

class ReviewTransformer extends Transformer
{
    protected $availableIncludes = ['reviewer'];

    public function transform(Review $review)
    {
        return [
            'id' => $review->getId(),
            'content' => $review->getContent(),
            'added_at' => $review->getAddedAt()->format(\DateTime::ATOM),
        ];
    }
}