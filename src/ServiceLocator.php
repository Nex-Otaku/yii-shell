<?php

namespace NexOtaku\YiiShell;

use Psr\Container\ContainerInterface;

class ServiceLocator
{
    private static $instance;

    private ContainerInterface $container;

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    public function registerContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function get(string $class)
    {
        if ($this->container === null) {
            throw new \LogicException('Cannot use DI container, please register it in Service Locator first');
        }

        return $this->container->get($class);
    }
}