<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Model;

class Review
{
    private $id;
    private $content;
    private $reviewer;
    private $addedAt;

    public function __construct(string $id, string $content, string $reviewer)
    {

        $this->id = $id;
        $this->content = $content;
        $this->reviewer = $reviewer;
        $this->addedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getReviewer(): string
    {
        return $this->reviewer;
    }

    /**
     * @return \DateTime
     */
    public function getAddedAt(): \DateTime
    {
        return clone $this->addedAt;
    }
}
