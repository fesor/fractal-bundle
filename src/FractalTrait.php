<?php

namespace Fesor\FractalBundle;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;

trait FractalTrait
{
    public function item($data, $transformer = null)
    {
        return new ResourceBuilder(new Item($data, $transformer));
    }

    public function collection(\iterable $data, $transformer = null)
    {
        return new ResourceBuilder(new Collection($data, $transformer));
    }

    public function primitive($data, $transformer = null)
    {
        return new ResourceBuilder(new Primitive($data, $transformer));
    }
}