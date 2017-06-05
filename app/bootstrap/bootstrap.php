<?php

use DI\ContainerBuilder;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../../vendor/autoload.php';
session_start();

$app = new class() extends \DI\Bridge\Slim\App {
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(
            file_exists(__DIR__ . '/../config/settings.php')
                ? __DIR__ . '/../config/settings.php' : __DIR__ . '/../config/settings.php.dist'
        );
        $builder->addDefinitions(__DIR__ . '/../config/dependencies.php');
    }
};

// Register the middleware
require __DIR__ . '/../config/middleware.php';

// Register the routes
require __DIR__ . '/../config/routes.php';

return $app;
