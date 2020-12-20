<?php

declare(strict_types=1);

namespace Absalon\Engine\Core\Router;

use Absalon\Engine\Core\Middleware\MiddlewareResolver;
use League\Route\Middleware\MiddlewareAwareInterface;
use League\Route\Route;

class RouteDecorator
{
    private Route $_route;

    public function __construct(Route $route){
        $this->_route = $route;
    }

    public function lazyMiddleware(string|array $middleware) : MiddlewareAwareInterface
    {
        if (is_array($middleware)){
            return $this->_route->lazyMiddlewares(MiddlewareResolver::resolve($middleware));
        }
        return $this->_route->lazyMiddleware(MiddlewareResolver::resolve($middleware));
    }

}