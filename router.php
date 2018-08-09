<?php

$router->get('/hello/{name}', function ($params, User $model) {
    return 'My name is ' . $params[1];
});
