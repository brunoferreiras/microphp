<?php

use BrunoFerreiras\DI\Resolver;
use BrunoFerreiras\Router\Router;
use BrunoFerreiras\Renderer\PHPRenderer;

require __DIR__ . '/vendor/autoload.php';

$path_info = $_SERVER['PATH_INFO'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$router = new Router($path_info, $request_method);

require __DIR__ . '/router.php';

$result = $router->run();

$data = (new Resolver)->method($result['callback'], [
    'params' => $result['params']
]);

$renderer = new PHPRenderer;
$renderer->setData($data);
$renderer->run();
