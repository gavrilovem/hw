<?php

namespace App\models;
class Sales extends Model
{
    protected function getTableName(): string
    {
        return 'sales';
    }

    protected function getTableColumns(): array
    {
        return [
            'sale_for' => 'sale_for',
            'sale_for_id' => 'sale_for_id',
            'discount' => 'discount'
        ];
    }
}