<?php
return [
    'profiler' => \Vulpix\Engine\Core\Middleware\ProfilerMiddleware::class,
    'memory-usage' => \Vulpix\Engine\Core\Middleware\MemoryUsageMiddleware::class,
    'auth' => \Absalon\Engine\AAIS\Middleware\AuthorizationMiddleware::class,
    'rbac' => \Vulpix\Engine\RBAC\Middleware\RBACMiddleware::class,
    #Cards
    'card-fields-validator' => \Absalon\Application\PatientCard\Card\Middleware\CardValidatorMiddleware::class,
    'card-create' => \Absalon\Application\PatientCard\Card\Middleware\CardCreateMiddleware::class,
    'card-update' => \Absalon\Application\PatientCard\Card\Middleware\CardUpdateMiddleware::class,
    #Cards Search
    'search-string-validator' => \Absalon\Application\PatientCard\Search\Middleware\SearchStringValidatorMiddleware::class,
    #Auth
    'credentials-validator' => \Absalon\Engine\AAIS\Middleware\CredentialsValidatorMiddleware::class,
    'refresh-token-validator' => \Absalon\Engine\AAIS\Middleware\RefreshTokenValidatorMiddleware::class,
    #Fluorography
    'fluorography-fields-validator' => \Absalon\Application\Fluorography\Middleware\FluororgraphyValidatorMiddleware::class,
    'fluorography-create' => \Absalon\Application\Fluorography\Middleware\FluorographyCreateMiddleware::class,
    'fluorography-update' => \Absalon\Application\Fluorography\Middleware\FluorographyUpdateMiddleware::class,
    #Vaccination
    'vaccination-fields-validator' => \Absalon\Application\Vaccinations\Middleware\VaccinationValidatorMiddleware::class,
    'vaccination-create' => \Absalon\Application\Vaccinations\Middleware\VaccinationCreateMiddleware::class,
    'vaccination-update' => \Absalon\Application\Vaccinations\Middleware\VaccinationUpdateMiddleware::class
];