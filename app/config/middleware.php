<?php
// Middleware
use Slim\Csrf\Guard;

/** @var Slim\App $app */
$app->add(Guard::class);
