<?php


namespace App\controllers;


abstract class ControllerFactory
{
    public function run($action)
    {
        if (empty($action)) {
            $action = $this->defaultAction;
        }

        $action .= 'Action';

        if (!method_exists($this, $action)) {
            return '404';
        }

        return $this->$action();
    }

    protected function render($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);
        return $this->renderTemplate('/layouts/main', [
            'content' => $content
        ]);
    }

    protected function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}