<?php


namespace App\services;


class Request
{
    protected array $params = [
        'get' => '',
        'post' => '',
        'files' => ''
    ];

    public function __construct()
    {
        session_start();
        $this->setParams();
    }

    protected function setParams()
    {
        $this->params = [
            'post' => $_POST,
            'get' => $_GET,
            'files' => $_FILES
        ];
    }

    public function files($key = '')
    {
        return $this->getParams($key, $this->params['files']);
    }

    public function get($key = '')
    {
        return $this->getParams($key, $this->params['get']);
    }

    public function post($key = '')
    {
        return $this->getParams($key, $this->params['post']);
    }

    public function getParams($key, $params)
    {
        if (empty($key)) {
            return $params;
        }

        if (key_exists($key, $params)) {
            return $params[$key];
        }
        return '';
    }
}