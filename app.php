<?php

require __DIR__ . '/vendor/autoload.php';

$router = new BrunoFerreiras\Router\Router;

$router->get('/hello', function() {
    return 'Hello!';
});