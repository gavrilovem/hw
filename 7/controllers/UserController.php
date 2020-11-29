<?php


namespace App\controllers;

class UserController extends ControllerFactory
{
    protected string $defaultAction = 'index';

    public function oneAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            $id = (int) $this->request->get('id');
            return $this->render('user', [
                'user' => $this->user->getOne(['id' => $id])
            ]);
        }
    }

    public function allAction()
    {
        if ($_SESSION['user']['is_admin'] == '1') {
            return $this->render(
                'users',
                [
                    'users' => $this->user->getAll()
                ]
            );
        }
    }

    public function signUpAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->request->post('user');
            $this->user->save([
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
            $inputUser = $this->request->post('user');
            $user = $this->user->getOne([
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