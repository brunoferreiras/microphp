<?php

namespace BrunoFerreiras\Router;

class Router
{
    private $collection;

    public function __construct()
    {
        $this->collection = new RouterCollection;
    }

    public function get($path, $callback)
    {
        $this->request('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->request('POST', $path, $callback);
    }

    public function request($method, $path, $callback)
    {
        $this->collection->add($method, $path, $callback);
    }
}
