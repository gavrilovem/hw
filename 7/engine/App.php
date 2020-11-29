<?php


namespace App\engine;

use App\services\Request;

class App
{
    public function run(Request $request)
    {

        $controller = 'user';
        if (!empty($request->get('c'))) {
            $controller = $request->get('c');
        }

        $action = '';
        if (!empty($request->get('a'))) {
            $action = $request->get('a');
        }

        $controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';
        if (!class_exists($controllerName)) {
            echo '404_c';
            return null;
        }

        $controllerObject = new $controllerName();
        return $controllerObject->run($action);
    }
}