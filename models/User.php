<?php

namespace App\models;
class User extends Model
{
    protected function getTableName(): string
    {
        return 'users';
    }

    protected function getTableColumns(): array
    {
        return [
            'login' => 'login',
            'password' => 'password'
        ];
    }
}