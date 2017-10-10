<?php

namespace Tests\Fesor\FractalBundle\Functional\Example\Model;

class Book
{
    private $id;
    private $name;
    private $author;
    private $reviews;
    private $addedAt;

    public function __construct(string $id, string $name, string $author)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->addedAt = new \DateTime();
        $this->reviews = [];
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function getAddedAt(): \DateTime
    {
        return clone $this->addedAt;
    }

    public function review(Reviewer $reviewer, string $content)
    {
        $review = new Review($content, $reviewer->getId());
    }
}
