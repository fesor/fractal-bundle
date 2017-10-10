<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Transformer;

use Fesor\FractalBundle\Transformer;
use League\Fractal\ParamBag;

class DifferentIncludesTransformer extends Transformer
{
    protected $availableIncludes = [
        'snake_case',
        'with-dash',
        'with space',
        'with-multiple-param-bags',
    ];

    public function transform($data)
    {
        return $data;
    }

    public function includeSnakeCase($data)
    {
        return $this->primitive(1);
    }

    public function includeWithDash($data)
    {
        return $this->primitive(2);
    }

    public function includeWithSpace($data, ParamBag $params)
    {
        $limit = $params->get('limit');
        return $this->primitive((int) reset($limit));
    }

    public function includeWithMultipleParamBags($data, ParamBag $one, ParamBag $two)
    {
        $limit = $one->get('limit');
        $offset = $two->get('offset');
        return $this->primitive([
            (int)reset($limit),
            (int)reset($offset)
        ]);
    }
}