<?php

namespace Bookshelf\Database\DomainMapper;

use Atlas\Orm\Mapper\RecordInterface;
use Bookshelf\Domain\Entity\Author;
use Atlas\Orm\Atlas;

class AuthorRecordMapper
{
    use Traits\PropertySetter;

    /** @var Atlas */
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function mapRecordToAuthor(RecordInterface $record): Author
    {
        $author = new Author($record->name, $record->biography);
        $this->setProperties($author, ['id' => $record->id]);

        return $author;
    }

    /**
     * @return Author[]
     */
    public function mapRecordsToAuthors(iterable $records): array
    {
        $authors = [];
        foreach ($records as $record) {
            $authors[] = $this->mapRecordToAuthor($record);
        }

        return $authors;
    }

    public function mapAuthorToRecord(Author $author, RecordInterface $record): void
    {
        $record->id = $author->getId();
        $record->name = $author->getName();
        $record->biography = $author->getBiography();
    }
}
