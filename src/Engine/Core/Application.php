<?php

declare(strict_types=1);

namespace Absalon\Engine\Core;

use Absalon\Engine\Core\Middleware\MiddlewareResolver;
use Absalon\Engine\Core\Router\RouteDecorator;
use Absalon\Engine\Core\Router\RouteGroupDecorator;
use Laminas\Diactoros\Response\JsonResponse;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{
    private $_router;

    public function __construct(Router $router){
        $this->_router  = $router;

    }

    public function pattern(string $alias, string $regex) : Router
    {
        return $this->_router->addPatternMatcher($alias, $regex);
    }

    public function pipe($name){
        $this->_router->lazyMiddleware(MiddlewareResolver::resolve($name));
    }

    public function group(string $prefix, callable $group){
        return new RouteGroupDecorator($this->_router->group($prefix, $group));
    }

    public function get(string $path, string $handler) : RouteDecorator
    {
        return new RouteDecorator($this->_router->get($path, $handler));
    }

    public function post(string $path, string $handler) : RouteDecorator
    {
        return new RouteDecorator($this->_router->post($path, $handler));
    }

    public function put(string $path, string $handler) : RouteDecorator
    {
        return new RouteDecorator($this->_router->put($path, $handler));
    }

    public function patch(string $path, string $handler) : RouteDecorator
    {
        return new RouteDecorator($this->_router->patch($path, $handler));
    }

    public function delete(string $path, string $handler) : RouteDecorator
    {
        return new RouteDecorator($this->_router->delete($path, $handler));
    }

    public function run(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            return $this->_router->dispatch($request);
        }
        catch (NotFoundException $e){
            $uri = $request->getUri()->getPath();
            $method = $request->getMethod();
            return new JsonResponse('Роут '. $uri. ' c методом ' .$method.' не найден', 404);
        }
    }
}