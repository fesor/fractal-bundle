<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Controller;

use Fesor\FractalBundle\FractalTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Tests\Fesor\FractalBundle\Functional\Example\Transformer\DifferentIncludesTransformer;

class TestController extends Controller
{
    use FractalTrait;

    public function differentIncludes(Request $request)
    {
        return $this->item([], new DifferentIncludesTransformer())->including($request->get('include'))->asJsonResponse();
    }
}