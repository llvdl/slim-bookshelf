<?php

namespace Bookshelf\Action\Author;

use Bookshelf\Domain\Repository\AuthorRepository;
use Bookshelf\Domain\Repository\BookRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Bookshelf\View\ViewInterface;

class ListBooksAction
{
    /** @var AuthorRepository */
    private $authorRepository;

    /** @var BookRepository */
    private $bookRepository;

    /** @var ViewInterface */
    private $view;

    public function __construct(
        AuthorRepository $authorRepository,
        BookRepository $bookRepository,
        ViewInterface $view
    ) {
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, ?int $authorId = null): ResponseInterface
    {
        $author = $this->authorRepository->findOneById((int) $authorId);
        if (!$author) {
            // not found
            throw new \Exception("Author {$params['author_id']} not found");
        }

        $books = $this->bookRepository->findBooksByAuthor($author);

        return $this->view->render($response, 'bookshelf/author/books.twig', [
            'author' => $author,
            'books' => $books,
        ]);
    }
}
