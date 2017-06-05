<?php

namespace Bookshelf\Action\Author;

use Bookshelf\View\ViewInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Bookshelf\Domain\Repository\AuthorRepository;

class ListAuthorsAction
{
    /** @var AuthorRepository */
    private $authorRepository;

    /** @var ViewInterface */
    private $view;

    public function __construct(AuthorRepository $authorRepository, ViewInterface $view)
    {
        $this->authorRepository = $authorRepository;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        return $this->view->render($response, 'bookshelf/author/list.twig', [
            'authors' => $this->authorRepository->findAll()
        ]);
    }
}
