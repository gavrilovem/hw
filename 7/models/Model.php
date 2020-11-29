<?php

namespace App\models;

use App\services\DB;

abstract class Model
{

    public function getDB(): DB
    {
        return DB::instance();
    }

    abstract protected function getTableName(): string;

    abstract protected function getTableColumns(): array;

    protected function insert($params)
    {
        $tableColumns = implode(', ', $this->getTableColumns());
        $insertColumns = ':' . implode(', :', $this->getTableColumns());
        $sql = "INSERT INTO {$this->getTableName()} ($tableColumns) VALUES ($insertColumns);";
        return $this->getDB()->execute($sql, $params);
    }

    protected function update($params)
    {
        $tableColumns = $this->getTableColumns();
        $updateColumns = [];
        foreach ($tableColumns as $column)
        {
            if ($params[$column] != '') {
                $updateColumns[] = "$column = :$column";
            } else {
                unset($params[$column]);
            }
        }
        $updateColumns = implode(', ', $updateColumns);
        $sql = "UPDATE {$this->getTableName()} SET $updateColumns WHERE id = :id";
        return $this->getDB()->execute($sql, $params);
    }

    public function save($params)
    {
        if (empty($params['id'])) {
            return $this->insert($params);
        } else {
            return $this->update($params);
        }
    }

    public function delete($params)
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        return $this->getDB()->execute($sql, $params);
    }

    public function getOne($params)
    {
        $condition = [];
        foreach ($params as $column => $value) {
            $condition[] = "$column = :$column";
        }
        $condition = implode(' AND ', $condition);
        $sql = "SELECT * FROM {$this->getTableName()} WHERE $condition";
        return $this->getDB()->getOne($sql, $params);
    }

    public function getAll($sql = '')
    {
        if (!$sql) {
            $sql = "SELECT * FROM {$this->getTableName()}";
        }
        return $this->getDB()->getAll($sql);
    }
}