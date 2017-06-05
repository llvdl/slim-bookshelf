<?php

namespace Bookshelf\Database\Repository;

use Atlas\Orm\Atlas;
use Bookshelf\Domain\Entity\Author;
use Bookshelf\Domain\Entity\Book;
use Bookshelf\Database\TableMapper\BookMapper;
use Bookshelf\Database\DomainMapper\BookRecordMapper;
use Bookshelf\Domain\Repository\BookRepository as BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    /** @var Atlas */
    private $atlas;

    /** @var BookRecordMapper */
    private $bookRecordMapper;

    public function __construct(Atlas $atlas, BookRecordMapper $bookRecordMapper)
    {
        $this->atlas = $atlas;
        $this->bookRecordMapper = $bookRecordMapper;
    }

    /**
     * @return Book[]
     */
    public function findAll(): array
    {
        $records = $this
            ->atlas
            ->select(BookMapper::class)
            ->with(['author'])
            ->fetchRecordSet();

        return $this->bookRecordMapper->mapRecordsToBooks($records);
    }

    /**
     * @return Book[]
     */
    public function findBooksByAuthor(Author $author): array
    {
        $records = $this
            ->atlas
            ->select(BookMapper::class)
            ->where('author_id = ?', $author->getId())
            ->with(['author'])
            ->fetchRecordSet();

        return $this->bookRecordMapper->mapRecordsToBooks($records);
    }
}
