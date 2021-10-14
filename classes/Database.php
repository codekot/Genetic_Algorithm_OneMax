<?php


namespace app\classes;


class Database
{
    private static ?Database $instance = null;
    private array $data;
    private int $id=1;

    public static function getInstance(): Database
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function insert(array $value): void
    {
        $this->data[$this->id] = $value;
        $this->id++;
    }

    public function getAll()
    {
        return $this->data;
    }

}