<?php

namespace Bookshelf\Domain;

use Assert\Assertion;

class Author
{
    /** @var int */
    private $id;

    /** @var int */
    private $name;

    /** @var int */
    private $biography;

    public function __construct(string $name, ?string $biography)
    {
        Assertion::notEmpty($name);
        Assertion::maxLength($name, 100);

        $this->name = $name;
        $this->biography = $biography;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function update(string $name, ?string $biography): void
    {
        $this->name = $name;
        $this->biography = trim($biography) === '' ? null : $biography;
    }
}
