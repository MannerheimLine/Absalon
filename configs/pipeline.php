<?php

$app->pipe(\Vulpix\Engine\Core\Middleware\ProfilerMiddleware::class);
$app->pipe(\Vulpix\Engine\Core\Middleware\MemoryUsageMiddleware::class);
$app->pipe(\Vulpix\Engine\Core\Middleware\RouterMiddleware::class);
$app->pipe('/cards',\Absalon\Application\PatientCard\Card\Middleware\CardCreateMiddleware::class);
//$app->pipe('/api',\Vulpix\Engine\AAIS\Middleware\AuthorizationMiddleware::class);
//$app->pipe('/api',\Vulpix\Engine\RBAC\Middleware\RBACMiddleware::class);
$app->pipe(\Vulpix\Engine\Core\Middleware\DispatcherMiddleware::class);
