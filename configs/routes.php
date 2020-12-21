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

#APP MIDDLEWARE
$app->pipe('profiler');
$app->pipe('memory-usage');

#Cards
$app
    ->get('/api/v1/cards/{id:uuid}', \Absalon\Application\PatientCard\Card\Actions\CardGetAction::class);
$app
    ->post('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardCreateAction::class)
    ->lazyMiddleware(['validator', 'card-create']);
$app
    ->put('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardUpdateAction::class)
    ->lazyMiddleware(['validator', 'card-update']);
$app
    ->patch('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardSwitchAction::class);
$app
    ->delete('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardDeleteAction::class);




