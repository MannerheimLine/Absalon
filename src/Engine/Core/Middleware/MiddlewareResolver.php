<?php

declare(strict_types=1);

namespace Absalon\Engine\Core\Middleware;

class MiddlewareResolver
{
    public static function resolve(string|array $name) : string|array
    {
        $middlewares = require "configs/middlewares.php";
        if (is_array($name)){
            $array = [];
            foreach ($name as $key => $value){
                $array[] = $middlewares[$value];
            }
            return $array;
        }
        return $middlewares[$name];
    }

}