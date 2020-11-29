<?php


namespace App\services\render;


interface IRenderer
{
    public function render($template, $params = []);
}