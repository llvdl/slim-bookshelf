<?php

namespace Bookshelf\Action\Book;

use Bookshelf\Repository\BookRepository;
use Bookshelf\View\ViewInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Bookshelf\Book;

class ListBooksAction
{
    /** @var BookRepository */
    private $bookRepository;

    /** @var ViewInterface */
    private $view;

    public function __construct(BookRepository $bookRepository, ViewInterface $view)
    {
        $this->bookRepository = $bookRepository;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, ?int $authorId = null): ResponseInterface
    {
        return $this->view->render($response, 'bookshelf/book/list.twig', [
            'books' => $this->bookRepository->findAll()
        ]);
    }
}
