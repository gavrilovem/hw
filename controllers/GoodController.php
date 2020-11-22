<?php


namespace App\controllers;

use \App\models\Category;
use \App\models\Good;

class GoodController
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

    protected function oneAction()
    {
        $id = $_GET['id'];
        return $this->render('good', [
            'good' => (new Good()) -> getOne(['id' => $id])
        ]);
    }

    public function allAction()
    {
        return $this->render(
            'goods',
            [
                'goods' => (new Good())->getAll()
            ]
        );
    }

    protected function deleteAction()
    {
        $id = $_GET['id'];
        (new Good())->delete(['id' => $id]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    protected function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $good = $_POST['good'];
            (new Good())->save($good);
            header('Location: ' . $_SERVER['REQUEST_URI']);
        }
        $id = $_GET['id'];
        return $this->render('saveGood', [
            'good' => (new Good())->getOne(['id' => $id]),
            'categories' => (new Category())->getAll()
        ]);
    }

    protected function render($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);
        return $this->renderTemplate('layouts/main', [
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