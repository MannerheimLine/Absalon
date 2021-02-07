<?php
return [
    'profiler' => \Vulpix\Engine\Core\Middleware\ProfilerMiddleware::class,
    'memory-usage' => \Vulpix\Engine\Core\Middleware\MemoryUsageMiddleware::class,
    'auth' => \Absalon\Engine\AAIS\Middleware\AuthorizationMiddleware::class,
    'rbac' => \Vulpix\Engine\RBAC\Middleware\RBACMiddleware::class,
    'card-fields-validator' => \Absalon\Application\PatientCard\Card\Middleware\CardValidatorMiddleware::class,
    'card-create' => \Absalon\Application\PatientCard\Card\Middleware\CardCreateMiddleware::class,
    'card-update' => \Absalon\Application\PatientCard\Card\Middleware\CardUpdateMiddleware::class,
    'search-string-validator' => \Absalon\Application\PatientCard\Search\Middleware\SearchStringValidatorMiddleware::class,
    'credentials-validator' => \Absalon\Engine\AAIS\Middleware\CredentialsValidatorMiddleware::class,
    'refresh-token-validator' => \Absalon\Engine\AAIS\Middleware\RefreshTokenValidatorMiddleware::class,
    'fluorography-fields-validator' => \Absalon\Application\Fluorography\Middleware\FluororgraphyValidatorMiddleware::class,
    'fluorography-create' => \Absalon\Application\Fluorography\Middleware\FluorographyCreateMiddleware::class,
    'fluorography-update' => \Absalon\Application\Fluorography\Middleware\FluorographyUpdateMiddleware::class
];