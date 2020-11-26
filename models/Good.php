<?php

namespace App\models;
class Good extends Model
{
    protected function getTableName(): string
    {
        return 'goods';
    }

    protected function getTableColumns(): array
    {
        return [
            'name' => 'name',
            'price' => 'price',
            'category_id' => 'category_id'
        ];
    }
}