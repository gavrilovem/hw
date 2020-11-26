<?php


namespace App\controllers;

use App\models\User;

class UserController extends ControllerFactory
{
    protected $defaultAction = 'index';

    public function oneAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            $id = (int)$_GET['id'];
            return $this->render('user', [
                'user' => (new User())->getOne(['id' => $id])
            ]);
        }
    }

    public function allAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            return $this->render(
                'users',
                [
                    'users' => (new User())->getAll()
                ]
            );
        }
    }

    public function signUpAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['user'];
            (new User)->save([
                'login' => $user['login'],
                'password' => password_hash($user['password'], PASSWORD_DEFAULT)
            ]);
        }
        return $this->render('sign');
    }

    public function signInAction()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and !isset($_SESSION['user'])) {
            $inputUser = $_POST['user'];
            $user = (new User())->getOne([
                'login' => $inputUser['login']
            ]);
            if ($user and password_verify($inputUser['password'], $user['password'])) {
                $_SESSION['user'] = $user;
            }
            header('Location: ' . '/');
        }
        return $this->render('sign');
    }

    public function signOutAction()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    protected function indexAction()
    {
        return $this->render('index', [
            'title' => 'Заголовок',
            'text' => 'Текст'
        ]);
    }
}