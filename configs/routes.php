<?php
/** @noinspection PhpParamsInspection */
/**
 * Examples of the routes
 *
 * Создание собственного паттерна для аргумента:
 * $app->pattern('uuid', '[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}');
 * Роут с использование мсозданного декоратора, укорачивающего имя миддлвара
 * $app->get('/api/v1/cards/{id:uuid}', '\Absalon\Application\PatientCard\Card\Actions\CardGetAction::handle')->lazyMiddleware('profiler');
 * Добавление мидлваров для группы роутов:
 * $app
 *      ->group('/api/v1/cards', function ($router) {
 *          $router->post('/', \Absalon\Application\PatientCard\Card\Actions\CardCreateAction::class);
 *          $router->put('/', \Absalon\Application\PatientCard\Card\Actions\CardUpdateAction::class);
 *      })->lazyMiddleware('validator');
 */

#App Middleware
$app->pipe('profiler');
$app->pipe('memory-usage');

#Cards
$app
    ->get('/api/v1/cards/{id:uuid}', \Absalon\Application\PatientCard\Card\Actions\CardGetAction::class);
$app
    ->post('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardCreateAction::class)
    ->lazyMiddleware(['card-fields-validator', 'card-create']);
$app
    ->put('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardUpdateAction::class)
    ->lazyMiddleware(['card-fields-validator', 'card-update']);
$app
    ->patch('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardSwitchAction::class);
$app
    ->delete('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardDeleteAction::class);

#Cards Search
$app
    ->get('/api/v1/search/cards', \Absalon\Application\PatientCard\Search\Actions\SearchCardsAction::class)
    ->lazyMiddleware('search-string-validator');

#Dispositions Search
$app
    ->get('/api/v1/search/regions', \Absalon\Application\PatientCard\Search\Actions\SearchRegionsAction::class)
    ->lazyMiddleware('search-string-validator');
$app
    ->get('/api/v1/search/districts', \Absalon\Application\PatientCard\Search\Actions\SearchDistrictsAction::class)
    ->lazyMiddleware('search-string-validator');
$app
    ->get('/api/v1/search/localities', \Absalon\Application\PatientCard\Search\Actions\SearchLocalitiesAction::class)
    ->lazyMiddleware('search-string-validator');
$app
    ->get('/api/v1/search/streets', \Absalon\Application\PatientCard\Search\Actions\SearchStreetsAction::class)
    ->lazyMiddleware('search-string-validator');

#Insurance Companies Search
$app
    ->get('/api/v1/search/insurance-companies', \Absalon\Application\PatientCard\Search\Actions\SearchInsuranceCompaniesAction::class)
    ->lazyMiddleware('search-string-validator');

#Talons
$app
    ->get('/api/v1/talons/{id:uuid}', \Absalon\Application\Talons\Actions\TalonShowAction::class);

#Authentication
$app->get('/api/v1/auth/doAuth', \Absalon\Engine\AAIS\Actions\AuthenticateAction::class)
    ->lazyMiddleware('credentials-validator');
$app->get('/api/v1/auth/doRefresh', \Absalon\Engine\AAIS\Actions\RefreshAction::class);


