<?php

namespace App\controllers;

use App\models\Category;
use App\models\Comments;
use App\models\Good;

class GoodController extends ControllerFactory
{
    protected $defaultAction = 'index';

    public function oneAction()
    {
        $id = (int)$_GET['id'];
        return $this->render('good', [
            'good' => (new Good())->getOne(['id' => $id]),
            'comments' => (new Comments())->getAll(
                "SELECT id, good_id, comment, created_at, 
                    (select login from users where users.id = comments.user_id) as user_login
                     FROM comments WHERE good_id = $id"
            )
        ]);
    }

    public function allAction()
    {
        return $this->render('goods', [
            'goods' => (new Good())->getAll()
        ]);
    }

    protected function deleteAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            $id = (int)$_GET['id'];
            (new Good())->delete(['id' => $id]);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    protected function createAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $good = $_POST['good'];
                (new Good())->save($good);
                header('Location: ' . $_SERVER['REQUEST_URI']);
            }
            $id = (int)$_GET['id'];
            return $this->render('saveGood', [
                'good' => (new Good())->getOne(['id' => $id]),
                'categories' => (new Category())->getAll()
            ]);
        }
    }

    protected function createCommentAction()
    {
        $comment = $_POST['value'];
        (new Comments())->save([
            'user_id' => $_SESSION['user']['id'],
            'text' => $comment
        ]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}