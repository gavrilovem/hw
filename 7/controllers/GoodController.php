<?php

namespace App\controllers;

class GoodController extends ControllerFactory
{
    protected string $defaultAction = 'index';

    public function oneAction()
    {
        $id = (int) $this->request->get('id');
        return $this->render('good', [
            'good' => $this->good->getOne(['id' => $id]),
            'comments' => $this->comments->getAll(
                "SELECT id, good_id, comment, created_at, 
                    (select login from users where users.id = comments.user_id) as user_login
                     FROM comments WHERE good_id = $id"
            )
        ]);
    }

    public function allAction()
    {
        return $this->render('goods', [
            'goods' => $this->good->getAll()
        ]);
    }

    protected function deleteAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            $id = (int) $this->request->get('id');;
            $this->good->delete(['id' => $id]);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    protected function createAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $good = (array) $this->request->post('good');
                $good['photo_name'] = (string) $this->request->files('good')['name']['file'];
                if ($good['photo_name'] != '') {
                    copy($this->request->files('good')['tmp_name']['file'],
                    dirname(__DIR__) . '/public/img/' . $this->request->files('good')['name']['file']);
                }
                $this->good->save($good);
                header('Location: ' . $_SERVER['REQUEST_URI']);
            }
            $id = (int) $this->request->get('id');;
            return $this->render('editGoodList', [
                'good' => $this->good->getOne(['id' => $id]),
                'categories' => $this->category->getAll()
            ]);
        } else {
            header('Location: /');
        }
    }

    protected function createCommentAction()
    {
        $comment = (string) $this->request->post('value');
        $this->comments->save([
            'good_id' => $this->request->post('id'),
            'user_id' => $_SESSION['user']['id'],
            'comment' => $comment
        ]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}