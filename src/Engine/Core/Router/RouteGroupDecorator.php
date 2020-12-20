<?php

declare(strict_types=1);

namespace Absalon\Engine\Core\Router;

use Absalon\Engine\Core\Middleware\MiddlewareResolver;
use League\Route\Middleware\MiddlewareAwareInterface;
use League\Route\RouteGroup;

class RouteGroupDecorator
{
    private RouteGroup $_routeGroup;

    public function __construct(RouteGroup $routeGroup){
        $this->_routeGroup = $routeGroup;
    }

    public function lazyMiddleware(string|array $middleware) : MiddlewareAwareInterface
    {
        if (is_array($middleware)){
            return $this->_routeGroup->lazyMiddlewares(MiddlewareResolver::resolve($middleware));
        }
        return $this->_routeGroup->lazyMiddleware(MiddlewareResolver::resolve($middleware));
    }

}