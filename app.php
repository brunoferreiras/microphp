<?php

require __DIR__ . '/vendor/autoload.php';

$app = new BrunoFerreiras\App;
$app->setRenderer(new BrunoFerreiras\Renderer\PHPRenderer);

$app->get('/hello/{name}', function ($params) {
    return $params;
});

$app->run();
