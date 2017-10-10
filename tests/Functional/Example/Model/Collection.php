<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Model;

class Collection
{
    private $data;

    public function __construct()
    {
    }

    public function add($item)
    {
        $this->data[] = $item;
    }

    public function toArray()
    {
        return $this->data;
    }
}
