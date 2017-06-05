<?php

namespace Bookshelf\Domain;

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
