<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Create App
$app = AppFactory::create();

// Create Twig
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Add routing middleware
$app->addRoutingMiddleware();

// Add error middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define routes
require __DIR__ . '/../routes/web.php';

// Run app
$app->run();