<?php

namespace Bookshelf\Domain;

interface AuthorRepository
{
    /**
     * @return Author[]
     */
    public function findAll(): array;

    public function findOneById(int $id): ?Author;

    public function save(Author $author): void;
}
