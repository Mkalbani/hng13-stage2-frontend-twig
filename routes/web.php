<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

// Landing Page
$app->get('/', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'pages/landing.html.twig');
});

// Auth Routes
$app->get('/auth/login', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'pages/auth/login.html.twig');
});

$app->get('/auth/signup', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'pages/auth/signup.html.twig');
});

// Dashboard
$app->get('/dashboard', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'pages/dashboard.html.twig');
});

// Tickets
$app->get('/tickets', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'pages/tickets.html.twig');
});