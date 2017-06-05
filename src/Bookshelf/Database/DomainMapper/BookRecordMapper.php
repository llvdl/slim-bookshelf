<?php

namespace Bookshelf\Database\DomainMapper;

use Bookshelf\Domain\Book;
use Atlas\Orm\Mapper\RecordInterface;

class BookRecordMapper
{
    use Traits\PropertySetter;

    /** @var AuthorRecordMapper */
    private $authorRecordMapper;

    public function __construct(AuthorRecordMapper $authorRecordMapper)
    {
        $this->authorRecordMapper = $authorRecordMapper;
    }

    /**
     * @return Book[]
     */
    public function mapRecordsToBooks(iterable $records): array
    {
        $books = [];
        foreach ($records as $record) {
            $books[] = $this->mapRecordToBook($record);
        }

        return $books;
    }

    public function mapRecordToBook(RecordInterface $record): Book
    {
        $author = $this->authorRecordMapper->mapRecordToAuthor($record->author);
        $book = new Book($record->title, $author, $record->isbn);

        return $book;
    }
}
