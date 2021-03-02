<?php

function app(string $class)
{
    $locator = \NexOtaku\YiiShell\ServiceLocator::getInstance();

    return $locator->get($class);
}
