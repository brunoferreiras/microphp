<?php

namespace BrunoFerreiras\ORM;

use BrunoFerreiras\ORM\Drivers\DriverStrategy;

class Model
{
    public function setDrive(DriverStrategy $driver)
    {
        return $driver;
    }

    protected function getDriver()
    {

    }

    public function save()
    {

    }

    public function findAll(array $conditions = [])
    {

    }

    public function findFirst($id)
    {

    }

    public function delete()
    {

    }
}