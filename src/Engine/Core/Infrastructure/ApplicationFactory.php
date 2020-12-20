<?php

declare(strict_types=1);

namespace Absalon\Engine\Core\Infrastructure;

use Absalon\Engine\Core\Application;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Container\ContainerInterface;

class ApplicationFactory
{
    public static function create(ContainerInterface $container)
    {
        $router = $container->get(Router::class);
        $strategy = (new ApplicationStrategy())->setContainer($container);
        return new Application($router->setStrategy($strategy));
    }

}