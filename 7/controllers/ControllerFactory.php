<?php


namespace App\controllers;


use App\models\User;
use App\models\Good;
use App\models\Category;
use App\models\Comments;
use App\services\Request;

abstract class ControllerFactory
{
    protected User $user;
    protected Good $good;
    protected Category $category;
    protected Comments $comments;
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->good = new Good;
        $this->comments = new Comments();
        $this->category = new Category();
        $this->user = new User();
    }

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