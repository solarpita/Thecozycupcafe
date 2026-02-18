<?php

// Auto-loading (simple version for now, later composer)
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Simple Router
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];

// Remove script path from URI to get relative path
// Example: /website1/public/index.php/login -> /login
$base_path = str_replace('\\', '/', dirname($script_name));

// Fix: if base_path ends with /public, remove it to match the rewritten URL
if (substr($base_path, -7) === '/public') {
    $base_path = substr($base_path, 0, -7);
}

$path = str_replace($base_path, '', $request_uri);
$path = strtok($path, '?'); // Remove query string

// Normalize path
$path = '/' . trim($path, '/');

// Routing Logic
switch ($path) {
    case '/':
    case '/home':
        $controller = new \App\Controllers\HomeController();
        $controller->index();
        break;
    case '/about':
        $controller = new \App\Controllers\HomeController();
        $controller->about();
        break;
    case '/menu':
        $controller = new \App\Controllers\MenuController();
        $controller->index();
        break;
    case '/contact':
        $controller = new \App\Controllers\ContactController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->submit();
        } else {
            $controller->index();
        }
        break;
    case '/login':
        $controller = new \App\Controllers\AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->loginForm();
        }
        break;
    case '/register':
        $controller = new \App\Controllers\AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->registerForm();
        }
        break;
    case '/payment':
        $controller = new \App\Controllers\PaymentController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->process();
        } else {
            $controller->index();
        }
        break;
    case '/logout':
         $controller = new \App\Controllers\AuthController();
         $controller->logout();
         break;
    default:
        // 404
        http_response_code(404);
        echo "404 Not Found";
        break;
}
