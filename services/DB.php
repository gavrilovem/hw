<?php

namespace App\services;
class DB
{
    use TSingleton;

    protected $connection;

    protected $connectionInfo = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'dbname' => 'gbphp',
        'user' => 'root',
        'passwd' => 'root'
    ];

    protected function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new \PDO(
                $this->getDSNString(),
                $this->connectionInfo['user'],
                $this->connectionInfo['passwd']
            );
            $this->connection->setAttribute(
            \PDO::ATTR_DEFAULT_FETCH_MODE,
            \PDO::FETCH_ASSOC
            );
        }
        return $this->connection;
    }

    protected function getDSNString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s',
            $this->connectionInfo['driver'],
            $this->connectionInfo['host'],
            $this->connectionInfo['dbname']
        );
    }

    protected function prepareQuery(string $sql, array $params = [])
    {
        $prep = $this->getConnection()->prepare($sql);
        $prep->execute($params);
        return $prep;
    }

    public function getAll($sql, $params = [])
    {
        $prep = $this->prepareQuery($sql, $params);
        $prep->setFetchMode(\PDO::FETCH_ASSOC);
        return $prep->fetchAll();
    }

    public function getOne($sql, $params = [])
    {
        $prep = $this->prepareQuery($sql, $params);
        $prep->setFetchMode(\PDO::FETCH_ASSOC);
        return $prep->fetch();
    }

    public function execute($sql, $params = [])
    {
        return $this->prepareQuery($sql, $params);
    }
}