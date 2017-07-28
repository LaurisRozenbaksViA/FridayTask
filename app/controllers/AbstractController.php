<?php

namespace PHPBootcamp\Controllers;

use PHPBootcamp\Controllers\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    /** @var \ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $dependencyContainer)
    {
        $this->container = $dependencyContainer;
    }

    public function render(string $template, array $content = []) : string
    {
        return include $template;
    }
}