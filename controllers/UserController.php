<?php


namespace App\controllers;

use App\models\User;

class UserController
{
    protected $defaultAction = 'index';

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

    protected function indexAction()
    {
        return $this->render('index', [
            'title' => 'Заголовок',
            'text' => 'Текст'
        ]);
    }

    public function allAction()
    {
        return $this->render(
            'users',
            [
                'users' => (new User())->getAll()
            ]
        );
    }

    public function oneAction()
    {
        $id = (int) $_GET['id'];
        return $this->render(
            'user',
            [
                'user' => (new User())->getOne(['id' => $id])
            ]
        );
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