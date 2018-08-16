<?php

namespace BrunoFerreiras\ORM;

use BrunoFerreiras\ORM\Drivers\DriverStrategy;

class Model
{
    protected $driver;

    public function setDrive(DriverStrategy $driver)
    {
        $this->driver;
        return $this;
    }

    protected function getDriver()
    {
        return $this->driver;
    }

    public function save()
    {
        $this->getDriver()
            ->save($this)
            ->exec();
    }

    public function findAll(array $conditions = [])
    {
        return $this->getDriver()
            ->select($conditions)
            ->exec()
            ->all();
    }

    public function findFirst($id)
    {
        return $this->getDriver()
            ->select(['id' => $id])
            ->exec()
            ->first();
    }

    public function delete()
    {
        $this->getDriver()
            ->delete(['id' => $this->id])
            ->exec();
    }
}
