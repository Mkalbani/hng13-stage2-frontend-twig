<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Create output directory
$outputDir = __DIR__ . '/../dist';
if (!file_exists($outputDir)) {
    mkdir($outputDir, 0777, true);
}

// Copy static assets
shell_exec("cp -r " . __DIR__ . "/../public/css " . $outputDir);
shell_exec("cp -r " . __DIR__ . "/../public/js " . $outputDir);

// Initialize Twig
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

// Pages to render
$pages = [
    'index.html' => 'pages/landing.html.twig',
    'auth/login/index.html' => 'pages/auth/login.html.twig',
    'auth/signup/index.html' => 'pages/auth/signup.html.twig',
    'dashboard/index.html' => 'pages/dashboard.html.twig',
    'tickets/index.html' => 'pages/tickets.html.twig'
];

// Render each page
foreach ($pages as $outputFile => $template) {
    $outputPath = $outputDir . '/' . $outputFile;
    $outputDir = dirname($outputPath);
    
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }
    
    $html = $twig->render($template, [
        'current_path' => '/' . dirname($outputFile),
        'session' => ['user' => null]
    ]);
    
    file_put_contents($outputPath, $html);
    echo "Generated: $outputFile\n";
}