<?php

namespace BrunoFerreiras\Renderer;

interface PHPRendererInterface
{
    public function setData($data);

    public function run();
}
