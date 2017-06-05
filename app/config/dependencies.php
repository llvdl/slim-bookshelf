<?php

use Atlas\Orm\Atlas;
use Atlas\Orm\AtlasContainer;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Bookshelf\View\ViewInterface;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;
use Bookshelf\Mapper\AuthorMapper;
use Bookshelf\Mapper\BookMapper;

return [
    ViewInterface::class => function (ContainerInterface $c) {
        $twig = new Twig($c->get('settings.view')['template_path'], $c->get('settings.view')['twig']);

        // Add extensions
        $twig->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
        $twig->addExtension(new Twig_Extension_Debug());
        $twig->addExtension(new Bookshelf\Twig\TwigExtension($c->get(Messages::class)));

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
    }
];
