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
    $pdo = new PDO('mysql:host=localhost;dbname=orm_php', 'root', 'root');

    $driver = new MysqlPdo($pdo);
    $driver->setTable('users');

    $model = new Model;
    $model->setDriver($driver);
    $model->name = 'Bruno';
    $model->age = 22;
    $model->email = 'fs.brunoferreira@gmail.com';
    $model->save();

    var_dump($model->findAll());
    var_dump($model->findFirst(1));

    return 'Finish';
});

$app->run();
