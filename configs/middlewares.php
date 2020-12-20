<?php
return [
    'profiler' => \Vulpix\Engine\Core\Middleware\ProfilerMiddleware::class,
    'memory-usage' => \Vulpix\Engine\Core\Middleware\MemoryUsageMiddleware::class,
    'auth' => \Vulpix\Engine\AAIS\Middleware\AuthorizationMiddleware::class,
    'rbac' => \Vulpix\Engine\RBAC\Middleware\RBACMiddleware::class,
    'validator' => \Absalon\Application\PatientCard\Card\Middleware\CardValidatorMiddleware::class,
    'card-create' => \Absalon\Application\PatientCard\Card\Middleware\CardCreateMiddleware::class,
    'card-update' => \Absalon\Application\PatientCard\Card\Middleware\CardUpdateMiddleware::class
];