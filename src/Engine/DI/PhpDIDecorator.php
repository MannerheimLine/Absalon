<?php

declare(strict_types=1);

namespace Absalon\Engine\DI;

use DI\Container;
use DI\ContainerBuilder;

class PhpDIDecorator
{
    private static function getDefinitions() : array
    {
        return require "configs/dependencies.php";
    }

    private static function getBuilderContainer() : Container
    {
        $dependencies = self::getDefinitions();
        $builder = new ContainerBuilder();
        $builder->addDefinitions($dependencies);
        return $builder->build();
    }

    public static function has(string $className) : bool
    {
        return (new Container())->has($className) ? true : false;
    }

    /**
     * Создать зависимый класс без использования заранее предопределенных объявлений(классы без завязки на интерфейсы)
     *
     * @param $className
     * @return mixed
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function create($className) : mixed
    {
        return (new Container())->get($className);
    }

    /**
     * Построить объект на основе заранее предопределенных зависимостях(классы на интерфейсах)
     *
     * @param $className
     * @return mixed
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function build($className) : mixed
    {
        return self::getBuilderContainer()->get($className);
    }

}