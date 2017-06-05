<?php

namespace Bookshelf\Domain\Repository;

use Bookshelf\Domain\Entity\Author;

interface AuthorRepository
{
    /**
     * @return Author[]
     */
    public function findAll(): array;

    public function findOneById(int $id): ?Author;

    public function save(Author $author): void;
}
