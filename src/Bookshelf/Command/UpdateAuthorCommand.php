<?php

namespace Bookshelf\Command;

use Bookshelf\Repository\AuthorRepository;
use Bookshelf\Domain\Author;

class UpdateAuthorCommand
{
    /** @var AuthorRepository */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function __invoke(Author $author, string $name, ?string $biography)
    {
        $author->update($name, $biography);

        $this->authorRepository->save($author);
    }
}
