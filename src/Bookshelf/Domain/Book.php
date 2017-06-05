<?php

namespace Bookshelf\Domain;

use Assert\Assertion;

class Book
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string|null */
    private $isbn;

    /** @var Author */
    private $author;

    public function __construct(string $title, Author $author, ?string $isbn)
    {
        Assertion::notEmpty($title);
        Assertion::nullOrMaxLength($isbn, 13);

        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }
}
