<?php

use BrunoFerreiras\DI\Resolver;
use BrunoFerreiras\Router\Router;

require __DIR__ . '/vendor/autoload.php';

$path_info = $_SERVER['PATH_INFO'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$router = new Router($path_info, $request_method);

// Only Resolver Test!
class User
{
    public function __construct($name = 'User class')
    {
        echo $name;
    }
}

require __DIR__ . '/router.php';

$result = $router->run();

$data = (new Resolver)->method($result['callback'], [
    'params' => $result['params']
]);

var_dump($data);
