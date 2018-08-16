<?php

use BrunoFerreiras\ORM\Drivers\MysqlPdo;
use BrunoFerreiras\ORM\Model;

require __DIR__ . '/vendor/autoload.php';

$app = new BrunoFerreiras\App;
$app->setRenderer(new BrunoFerreiras\Renderer\PHPRenderer);

$app->get('/hello/{name}', function ($params) {
    return $params;
});

$app->get('/model', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=orm_php', 'root', '');
    $driver = new MysqlPdo($pdo);

    $model = new Model;
    var_dump($driver);
});

$app->run();
