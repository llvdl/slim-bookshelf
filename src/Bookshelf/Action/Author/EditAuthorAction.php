<?php

namespace Bookshelf\Action\Author;

use Bookshelf\Command\UpdateAuthorCommand;
use Bookshelf\Domain\AuthorRepository;
use Bookshelf\View\ViewInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Flash\Messages;
use Slim\Interfaces\RouterInterface;

class EditAuthorAction
{
    /** @var AuthorRepository */
    private $authorRepository;

    /** @var UpdateAuthorCommand */
    private $updateAuthorCommand;

    /** @var ViewInterface */
    private $view;

    /** @var Messages */
    private $flash;

    /** @var RouterInterface */
    private $router;

    public function __construct(
        AuthorRepository $authorRepository,
        UpdateAuthorCommand $updateAuthorCommand,
        ViewInterface $view,
        Messages $messages,
        RouterInterface $router
    ) {
        $this->authorRepository = $authorRepository;
        $this->updateAuthorCommand = $updateAuthorCommand;
        $this->view = $view;
        $this->flash = $messages;
        $this->router = $router;
    }

    public function __invoke(Request $request, Response $response, int $authorId): ResponseInterface
    {
        $author = $this->authorRepository->findOneById($authorId);
        if (!$author) {
            $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('list-authors'));
            return $response->withRedirect((string)$uri);
        }

        $errors = null;
        if ($request->isPost()) {
            if ($request->getAttribute('csrf_status') === false) {
                $errors['form'] = 'CSRF faiure';
            } else {
                if ($request->getAttribute('has_errors')) {
                    $errors = $request->getAttribute('errors');
                } else {
                    $data = $request->getParsedBody();
                    ($this->updateAuthorCommand)($author, $data['name'], $data['biography']);

                    $this->flash->addMessage('message', 'Author updated');

                    $uri = $request
                            ->getUri()
                            ->withQuery('')
                            ->withPath($this->router->pathFor('author', ['authorId' => $author->getId()]));
                    return $response->withRedirect((string)$uri);
                }
            }
        }

        return $this->view->render($response, 'bookshelf/author/edit.twig', [
            'author' => $author,
            'errors' => $errors,
            'csrf' => [
                'name' => $request->getAttribute('csrf_name'),
                'value' => $request->getAttribute('csrf_value'),
            ],
        ]);
    }
}
