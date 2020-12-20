<?php

use Absalon\Engine\Core\Infrastructure\ApplicationFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

#Автозагрузка
chdir(dirname(__DIR__));
require "vendor/autoload.php";

#Инициализация
require "configs/container.php";
$app = ApplicationFactory::create($container);

#Загрузка
require "configs/routes.php";

#Запуск приложения
$request = ServerRequestFactory::fromGlobals();
$response = $app->run($request);

#Отправка клиенту
$emitter = new SapiEmitter();
$emitter->emit($response);
