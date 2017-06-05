<?php

namespace Bookshelf\View;

use Psr\Http\Message\ResponseInterface;

interface ViewInterface
{
    /**
     * Output rendered template
     *
     * @param ResponseInterface $response
     * @param  string $template Template pathname relative to templates directory
     * @param  array $data Associative array of template variables
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, $data = []): ResponseInterface;
}
