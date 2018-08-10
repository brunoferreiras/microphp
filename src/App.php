<?php

namespace BrunoFerreiras;

use BrunoFerreiras\DI\Resolver;
use BrunoFerreiras\Router\Router;
use BrunoFerreiras\Renderer\PHPRendererInterface;

class App
{
    private $router;
    private $renderer;

    public function __construct()
    {
        $path_info = $_SERVER['PATH_INFO'] ?? '/';
        $request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->router = new Router($path_info, $request_method);
    }

    public function setRenderer(PHPRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function get(string $path, $callback)
    {
        $this->router->get($path, $callback);
    }

    public function post(string $path, $callback)
    {
        $this->router->post($path, $callback);
    }

    public function run()
    {
        $route = $this->router->run();
        $resolver = new Resolver;

        $data = $resolver->method($route['callback'], ['params' => $route['params']]);

        $this->renderer->setData($data);
        $this->renderer->run();
    }
}
