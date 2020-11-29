<?php
namespace App\services;

trait TSingleton
{
    static protected $item;

    public static function instance()
    {
        if (empty(static::$item)) {
            static::$item = new static();
        }

        return static::$item;
    }
}
