<?php

namespace Bookshelf\Database\Repository;

use Atlas\Orm\Mapper\RecordInterface;
use Bookshelf\Domain\Author;
use Atlas\Orm\Atlas;
use Bookshelf\Database\TableMapper\AuthorMapper;
use Bookshelf\Database\DomainMapper\AuthorRecordMapper;
use Bookshelf\Domain\AuthorRepository as AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    /** @var Atlas */
    private $atlas;

    /** @var AuthorRecordMapper */
    private $authorRecordMapper;

    public function __construct(Atlas $atlas, AuthorRecordMapper $authorRecordMapper)
    {
        $this->atlas = $atlas;
        $this->authorRecordMapper = $authorRecordMapper;
    }

    /**
     * @return Author[]
     */
    public function findAll(): array
    {
        $records = $this
            ->atlas
            ->select(AuthorMapper::class)
            ->fetchRecords();

        return $this->authorRecordMapper->mapRecordsToAuthors($records);
    }

    public function findOneById(int $id): ?Author
    {
        $record = $this->fetchAuthorRecordById($id);
        return $record === null ? null : $this->authorRecordMapper->mapRecordToAuthor($record);
    }

    public function save(Author $author): void
    {
        if ($author->getId()) {
            $record = $this->fetchAuthorRecordById($author->getId());
        } else {
            $record = $this->atlas->newRecord(AuthorMapper::class);
        }

        $this->authorRecordMapper->mapAuthorToRecord($author, $record);

        $transaction = $this->atlas->newTransaction();

        if ($record->id) {
            $transaction->update($record);
        } else {
            $transaction->insert($record);
        }

        $transaction->exec();
    }

    private function fetchAuthorRecordById(int $id): ?RecordInterface
    {
        $record = $this
            ->atlas
            ->select(AuthorMapper::class, ['id' => $id])
            ->fetchRecord();

        return $record === false ? null : $record;
    }
}
