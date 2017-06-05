<?php

namespace Tests\Bookshelf\Domain\Entity;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

use Bookshelf\Domain\Entity\Author;

class AuthorTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function itCanBeConstructedWithoutBiography()
    {
        $author = new Author('Albert Beta', null);

        $this->assertSame('Albert Beta', $author->getName());
        $this->assertSame(null, $author->getBiography());
        $this->assertSame(null, $author->getId());
    }

    /** @test */
    public function itCanBeConstructedWithBiography()
    {
        $author = new Author('Albert Beta', 'A person living inside a world.');

        $this->assertSame('Albert Beta', $author->getName());
        $this->assertSame('A person living inside a world.', $author->getBiography());
        $this->assertSame(null, $author->getId());
    }

    /** @test */
    public function nameMayNotBeEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $author = new Author('', 'A person living inside a world.');
    }

    /** @test */
    public function nameMayNotBeTooLong()
    {
        $author = new Author(str_repeat('a', 100), 'A person living inside a world.');

        $this->assertSame(100, strlen($author->getName()), 'up to 100 characters are allowed');

        $this->expectException(InvalidArgumentException::class);

        $author = new Author(str_repeat('a', 101), 'A person living inside a world.');
    }

    /** @test */
    public function updateWithoutBiography()
    {
        $author = new Author('Albert Beta', 'A person living inside a world.');

        $author->update('Albert B. Beta', '');

        $this->assertSame('Albert B. Beta', $author->getName());
        $this->assertSame(null, $author->getBiography(), 'empty string is stored as null for biography');
    }

    /** @test */
    public function updateWithBiography()
    {
        $author = new Author('Albert Beta', 'A person living inside a world.');

        $author->update('Albert B. Beta', 'A person amongst others.');

        $this->assertSame('Albert B. Beta', $author->getName());
        $this->assertSame('A person amongst others.', $author->getBiography());
    }
}
