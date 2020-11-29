<?php

namespace App\services;
class Autoload
{
    public function loadClass($className)
    {
        $baseDir = dirname(__DIR__) . '/';
        $fileName = str_replace(
            ['App\\', '\\'],
            [$baseDir, '\\'],
             $className
        ) . '.php';

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}