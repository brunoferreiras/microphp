<?php

use BrunoFerreiras\ORM\Drivers\MysqlPdo;
use App\Model\Users;

require __DIR__ . '/vendor/autoload.php';

$app = new BrunoFerreiras\App;
$app->setRenderer(new BrunoFerreiras\Renderer\PHPRenderer);

$app->get('/hello/{name}', function ($params) {
    return $params;
});

$app->get('/model', function () {
    $pdo = new PDO('mysql:host=localhost;dbname=orm_php', 'root', '');

    $driver = new MysqlPdo($pdo);
    $driver->exec('truncate users;');

    echo 'Save register </br>';
    $model = new Users;
    $model->setDriver($driver);
    $model->name = 'Bruno';
    $model->age = 22;
    $model->email = 'fs.brunoferreira@gmail.com';
    $model->save();

    $model->name = 'Other';
    $model->age = 25;
    $model->email = 'other@gmail.com';
    $model->save();

    echo 'Find all registers </br>';
    echo '<pre>';
    var_dump($model->findAll());
    echo '</pre>';
    
    echo 'Find the first register </br>';
    echo '<pre>';
    var_dump($model->findFirst(1));
    echo '</pre>';

    echo 'Update register </br>';
    $model->id = 2;
    $model->name = 'José';
    $model->save();

    echo '<pre>';
    var_dump($model->findFirst(2));
    echo '</pre>';

    echo 'Delete register </br>';
    $model->id = 1;
    $model->delete();
    echo '<pre>';
    var_dump($model->findAll());
    echo '</pre>';
    return 'Finish';
});

$app->run();
