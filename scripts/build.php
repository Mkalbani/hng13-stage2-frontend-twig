<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Get base path from environment or use default
$basePath = getenv('BASE_PATH') ?: '/hng13-stage2-frontend-twig';

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

// Add base_path as a global variable
$twig->addGlobal('base_path', $basePath);

// Pages to render
$pages = [
    'index.html' => ['template' => 'pages/landing.html.twig', 'path' => '/'],
    'auth/login/index.html' => ['template' => 'pages/auth/login.html.twig', 'path' => '/auth/login'],
    'auth/signup/index.html' => ['template' => 'pages/auth/signup.html.twig', 'path' => '/auth/signup'],
    'dashboard/index.html' => ['template' => 'pages/dashboard.html.twig', 'path' => '/dashboard'],
    'tickets/index.html' => ['template' => 'pages/tickets.html.twig', 'path' => '/tickets']
];

// Render each page
foreach ($pages as $outputFile => $config) {
    $outputPath = $outputDir . '/' . $outputFile;
    $outputFileDir = dirname($outputPath);
    
    if (!file_exists($outputFileDir)) {
        mkdir($outputFileDir, 0777, true);
    }
    
    $html = $twig->render($config['template'], [
        'current_path' => $config['path'],
        'session' => ['user' => null],
        'base_path' => $basePath
    ]);
    
    // Fix asset paths
    $html = str_replace('href="/css/', 'href="' . $basePath . '/css/', $html);
    $html = str_replace('src="/js/', 'src="' . $basePath . '/js/', $html);
    
    file_put_contents($outputPath, $html);
    echo "Generated: $outputFile\n";
}

// Create 404.html for client-side routing fallback
$notFoundHtml = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        const basePath = '{$basePath}';
        const path = window.location.pathname.replace(basePath, '');
        
        const routes = {
            '': '/index.html',
            '/': '/index.html',
            '/auth/login': '/auth/login/index.html',
            '/auth/signup': '/auth/signup/index.html',
            '/dashboard': '/dashboard/index.html',
            '/tickets': '/tickets/index.html'
        };
        
        const targetPath = routes[path] || routes[path + '/'] || '/index.html';
        window.location.href = basePath + targetPath;
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>
HTML;

file_put_contents($outputDir . '/404.html', $notFoundHtml);
echo "Generated: 404.html\n";

// Create a custom app.js with base path
$appJsPath = $outputDir . '/js/app.js';
$appJsContent = file_get_contents(__DIR__ . '/../public/js/app.js');

// Add base path constant at the top
$basePathJs = "const BASE_PATH = '{$basePath}';\n\n";
$appJsContent = $basePathJs . $appJsContent;

// Replace all absolute paths
$appJsContent = str_replace("window.location.href = '/dashboard'", "window.location.href = BASE_PATH + '/dashboard/'", $appJsContent);
$appJsContent = str_replace("window.location.href = '/auth/login'", "window.location.href = BASE_PATH + '/auth/login/'", $appJsContent);
$appJsContent = str_replace("window.location.href = '/tickets'", "window.location.href = BASE_PATH + '/tickets/'", $appJsContent);
$appJsContent = str_replace('href="/"', 'href="\' + BASE_PATH + \'/\'"', $appJsContent);
$appJsContent = str_replace('href="/auth/', 'href="\' + BASE_PATH + \'/auth/', $appJsContent);
$appJsContent = str_replace('href="/dashboard"', 'href="\' + BASE_PATH + \'/dashboard\'"', $appJsContent);

file_put_contents($appJsPath, $appJsContent);
echo "Updated: js/app.js with base path\n";

echo "\nBuild completed successfully!\n";
echo "Base path: {$basePath}\n";