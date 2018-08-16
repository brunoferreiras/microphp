<?php

namespace BrunoFerreiras\ORM\Drivers;

use BrunoFerreiras\ORM\Model;

interface DriverStrategy
{
    public function save(Model $data);

    public function select(array $data = []);

    public function delete(array $data = []);

    public function exec(string $query = null);

    public function first();

    public function all();
}
