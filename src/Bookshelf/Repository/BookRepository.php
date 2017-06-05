<?php

namespace Bookshelf\Repository;

use Atlas\Orm\Atlas;
use Bookshelf\Domain\Author;
use Bookshelf\Domain\Book;
use Bookshelf\Mapper\BookMapper;
use Bookshelf\Repository\Mapper\BookRecordMapper;

class BookRepository
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
        $records = $this->atlas->select(BookMapper::class)->with(['author'])->fetchRecordSet();

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
