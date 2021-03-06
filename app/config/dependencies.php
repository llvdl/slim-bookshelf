<?php

use Atlas\Orm\Atlas;
use Atlas\Orm\AtlasContainer;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Bookshelf\View\ViewInterface;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;
use Bookshelf\Database\TableMapper\AuthorMapper;
use Bookshelf\Database\TableMapper\BookMapper;
use Bookshelf\Domain\Repository\AuthorRepository as AuthorRepositoryInterface;
use Bookshelf\Database\Repository\AuthorRepository;
use Bookshelf\Domain\Repository\BookRepository as BookRepositoryInterface;
use Bookshelf\Database\Repository\BookRepository;
use Monolog\Logger;
use Monolog\Handler\ErrorLogHandler;

return [
    ViewInterface::class => function (ContainerInterface $c) {
        $twig = new Twig($c->get('settings.view')['template_path'], $c->get('settings.view')['twig']);

        // Add extensions
        $twig->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
        $twig->addExtension(new Twig_Extension_Debug());

        $twig->getEnvironment()->addGlobal('flash_messages', $c->get(Messages::class)); 

        return new class($twig) implements ViewInterface {
            /** @var Twig */
            private $twig;

            public function __construct(Twig $twig)
            {
                $this->twig = $twig;
            }

            public function render(ResponseInterface $response, $template, $data = []): ResponseInterface
            {
                return $this->twig->render($response, $template, $data);
            }
        };
    },
    Guard::class => function (ContainerInterface $c) {
        $guard = new \Slim\Csrf\Guard();
        $guard->setFailureCallable(function (Request $request, Response $response, callable $next) {
            $request = $request->withAttribute("csrf_status", false);
            return $next($request, $response);
        });
        return $guard;
    },
    RouterInterface::class => function (ContainerInterface $c) {
        return $c->get('router');
    },
    AtlasContainer::class => function (ContainerInterface $c) {
        $settings = $c->get('settings.db');
        $atlasContainer = new AtlasContainer(
            sprintf('%s:host=%s;dbname=%s', $settings['driver'], $settings['host'], $settings['database']),
            $settings['username'],
            $settings['password']
        );

        $atlasContainer->setMappers([
            AuthorMapper::class,
            BookMapper::class
        ]);

        return $atlasContainer;
    },
    Atlas::class => function (ContainerInterface $c) {
        $atlas = $c->get(AtlasContainer::class)->getAtlas();

        return $atlas;
    },
    AuthorRepositoryInterface::class => function (ContainerInterface $c) {
        return $c->get(AuthorRepository::class);
    },
    BookRepositoryInterface::class => function (ContainerInterface $c) {
        return $c->get(BookRepository::class);
    },
    LoggerInterface::class => function (ContainerInterface $c) {
        $logger = new Logger('app_logger');
        $logger->pushHandler(new ErrorLogHandler());

        return $logger;
    },
    Messages::class => function (ContainerInterface $c) {
        return new Messages();
    }
];
