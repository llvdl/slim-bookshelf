<?php

namespace Bookshelf\Domain\Command;

use Bookshelf\Domain\Repository\AuthorRepository;
use Bookshelf\Domain\Entity\Author;
use Psr\Log\LoggerInterface;

class UpdateAuthorCommand
{
    /** @var AuthorRepository */
    private $authorRepository;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(AuthorRepository $authorRepository, LoggerInterface $logger)
    {
        $this->authorRepository = $authorRepository;
        $this->logger = $logger;
    }

    public function __invoke(Author $author, string $name, ?string $biography)
    {
        $author->update($name, $biography);

        $this->authorRepository->save($author);

        $this->logger->info(sprintf('Updated author with id %d', $author->getId()));
    }
}
