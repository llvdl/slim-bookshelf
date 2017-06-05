<?php

namespace Tests\Bookshelf\Domain;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

use Bookshelf\Domain\Book;
use Bookshelf\Domain\Author;

class BookTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function itCanBeConstructedWithoutIsbn()
    {
        $author = new Author('Albert Beta', null);
        $book = new Book('Meta Synonyms', $author, null);

        $this->assertSame('Meta Synonyms', $book->getTitle());
        $this->assertSame($author, $book->getAuthor());
        $this->assertSame(null, $book->getIsbn());
    }

    /** @test */
    public function itCanBeConstructedWithIsbn()
    {
        $author = new Author('Albert Beta', null);
        $book = new Book('Meta Synonyms', $author, '1234567890123');

        $this->assertSame('Meta Synonyms', $book->getTitle());
        $this->assertSame($author, $book->getAuthor());
        $this->assertSame('1234567890123', $book->getIsbn());
    }

    /** @test */
    public function titleMayNotBeEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $author = new Author('Albert Beta', null);
        $book = new Book('', $author, '1234567890123');
    }

    /** @test */
    public function isbnMayNotBeTooLong()
    {
        $this->expectException(InvalidArgumentException::class);

        $author = new Author('Albert Beta', null);
        $book = new Book('', $author, '12345678901234');
    }
}
