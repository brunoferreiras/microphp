<?php

namespace BrunoFerreiras\ORM\Drivers;

use BrunoFerreiras\ORM\Model;

class MysqlPdo implements DriverStrategy
{
    protected $pdo;
    protected $table;
    protected $query;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
        return $this;
    }

    public function save(Model $data)
    {
        if (!empty($data->id)) {
            $query = 'UPDATE %s SET %s';
            $dataToUpdate = $this->params($data);
            $query = sprintf($query, $this->table, $dataToUpdate);
            $query .= ' WHERE id = :id';
            
            $this->query = $this->pdo->prepare($query);
            $this->bind($data);
            return $this;
        }
        $query = 'INSERT INTO %s (%s) VALUES (%s)';

        $fields = [];
        $fieldsToBind = [];

        foreach ($data as $field => $value) {
            $fields[] = $field;
            $fieldsToBind[] = ':' . $field;
        }

        $fields = implode(', ', $fields);
        $fieldsToBind = implode(', ', $fieldsToBind);

        $query = sprintf($query, $this->table, $fields, $fieldsToBind);

        $this->query = $this->pdo->prepare($query);

        $this->bind($data);

        return $this;
    }

    public function select(array $conditions = [])
    {
        $query = 'SELECT * FROM ' . $this->table;
        $data = $this->params($conditions);

        if ($data) {
            $query .= ' WHERE ' . $data;
        }

        $this->query = $this->pdo->prepare($query);

        $this->bind($conditions);

        return $this;
    }

    public function delete(array $conditions)
    {
        $query = 'DELETE FROM ' . $this->table;
        $data = $this->params($conditions);
        $query .= ' WHERE ' . $data;

        $this->query = $this->pdo->prepare($query);

        $this->bind($conditions);

        return $this;
    }

    public function exec(string $query = null)
    {
        if ($query) {
            $this->query = $this->pdo->prepare($query);
        }
        $this->query->execute();
        return $this;
    }

    public function first()
    {
        return $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    public function all()
    {
        return $this->query->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function params($conditions)
    {
        $fields = [];

        foreach ($conditions as $field => $value) {
            $fields[] = $field . '=:' . $field;
        }

        return implode(', ', $fields);
    }

    protected function bind($conditions)
    {
        foreach ($conditions as $field => $value) {
            $this->query->bindValue($field, $value);
        }
    }
}
