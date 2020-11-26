<?php
include dirname(__DIR__) . '/vendor/autoload.php';

$db = new App\services\DB();
$user = new App\models\User();
session_start();

$controller = 'user';
if (!empty($_GET['c'])) {
    $controller = trim($_GET['c']);
}

$action = '';
if (!empty($_GET['a'])) {
    $action = trim($_GET['a']);
}

$controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';
if (!class_exists($controllerName)) {
    echo '404_c';
    return;
}

/** @var App\models\User */
$controllerObject = new $controllerName();
echo $controllerObject->run($action);