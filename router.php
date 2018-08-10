<?php

$router->get('/hello/{name}', function ($params) {
    return $params;
});
