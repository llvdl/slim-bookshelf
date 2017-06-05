<?php
// Route configuration

use Bookshelf\Action\Author;
use Bookshelf\Action\Book;
use Bookshelf\Validation\AuthorValidation;

/** @var Slim\App $app */

$app->get('/', Author\ListAuthorsAction::class)
    ->setName('list-authors');

$app->map(['GET', 'POST'], '/authors/{authorId:[0-9]+}/edit', Author\EditAuthorAction::class)
    ->add(new AuthorValidation())
    ->setName('edit-author');

$app->get('/authors/{authorId:[0-9]+}', Author\ListBooksAction::class)
    ->setName('author');

$app->get('/books', Book\ListBooksAction::class)
    ->setName('list-books');
