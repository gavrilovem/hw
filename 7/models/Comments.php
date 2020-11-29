<?php

namespace App\models;


class Comments extends Model
{
    protected function getTableName(): string
    {
        return 'comments';
    }

    protected function getTableColumns(): array
    {
        return [
            'good_id' => 'good_id',
            'user_id' => 'user_id',
            'comment' => 'comment'
        ];
    }
}