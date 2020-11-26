<?php


namespace App\models;


class Category extends Model
{
    protected function getTableName(): string
    {
        return 'categories';
    }

    protected function getTableColumns(): array
    {
        return [
            'name' => 'name'
        ];
    }
}