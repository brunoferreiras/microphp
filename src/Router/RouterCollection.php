<?php

namespace BrunoFerreiras\Router;

use Illuminate\Support\Collection;

class RouterCollection
{
    protected $collection = [];

    public function add(string $method, string $path, $callback)
    {
        if (!isset($this->collection[$method])) {
            $this->collection[$method] = new Collection;
        }
        $this->collection[$method]->put($path, $callback);
    }
}
