<?php

namespace Bookshelf\Domain\Entity;

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

        $this->setName($name);
        $this->setBiography($biography);
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
        $this->setName($name);
        $this->setBiography($biography);
    }

    private function setName(string $name): void
    {
        Assertion::notEmpty($name);
        Assertion::maxLength($name, 100);

        $this->name = $name;
    }

    private function setBiography(?string $biography): void
    {
        if (trim($biography) === '') {
            $biography = null;
        }

        $this->biography = $biography;
    }
}
