<?php

namespace Bookshelf\Domain\Repository;

use Bookshelf\Domain\Entity\Author;
use Bookshelf\Domain\Entity\Book;

interface BookRepository
{
    /**
     * @return Book[]
     */
    public function findAll(): array;

    /**
     * @return Book[]
     */
    public function findBooksByAuthor(Author $author): array;
}
