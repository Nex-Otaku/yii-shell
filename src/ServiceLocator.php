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

    public static function get(string $class)
    {
        $locator = self::getInstance();
        $container = $locator->container;

        if ($container === null) {
            throw new \LogicException('Cannot use DI container, please register it in Service Locator first');
        }

        return $container->get($class);
    }
}