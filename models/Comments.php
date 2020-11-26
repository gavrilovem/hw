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
            'user_id' => 'user_id',
            'comment' => 'comment',
            'created_at' => 'created_at'
        ];
    }
}