<?php
session_start();
include dirname(__DIR__) . '/vendor/autoload.php';

$request = new App\services\Request();
echo (new App\engine\App)->run($request);