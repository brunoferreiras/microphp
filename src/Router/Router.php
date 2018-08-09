<?php

namespace BrunoFerreiras\Router;

class Router
{
    private $collection;
    private $method;
    private $path;

    public function __construct(string $path, string $method)
    {
        $this->collection = new RouterCollection;
        $this->method = $method;
        $this->path = $path;
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

    public function run()
    {
        $data = $this->collection->filter($this->method);

        foreach ($data as $key => $value) {
            $result = $this->checkUrl($key, $this->path);
            $callback = $value;
            if ($result['result']) {
                break;
            }
        }

        if (!$result['result']) {
            $callback = null;
        }

        return [
            'params' => $result['params'],
            'callback' => $callback
        ];
    }

    private function checkUrl(string $toFind, $subject)
    {
        preg_match_all('/\{([^\}]*)\}/', $toFind, $variables);

        $regex = str_replace('/', '\/', $toFind);

        foreach ($variables[1] as $key => $variable) {
            $as = explode(':', $variable);
            $replacement = $as[1] ?? '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variables[$key], $replacement, $regex);
        }
        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);
        $result = preg_match('/^' . $regex . '$/', $subject, $params);

        return compact('result', 'params');
    }
}
