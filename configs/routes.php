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
    ->get('/api/v1/cards/{id:uuid}', \Absalon\Application\PatientCard\Card\Actions\CardGetAction::class)
    ->lazyMiddleware('auth');
$app
    ->post('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardCreateAction::class)
    ->lazyMiddleware(['auth', 'card-fields-validator', 'card-create']);
$app
    ->put('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardUpdateAction::class)
    ->lazyMiddleware(['auth', 'card-fields-validator', 'card-update']);
$app
    ->patch('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardSwitchAction::class)
    ->lazyMiddleware('auth');
$app
    ->delete('/api/v1/cards', \Absalon\Application\PatientCard\Card\Actions\CardDeleteAction::class)
    ->lazyMiddleware('auth');

#Cards Search
$app
    ->get('/api/v1/search/cards', \Absalon\Application\PatientCard\Search\Actions\SearchCardsAction::class)
    ->lazyMiddleware(['auth', 'search-string-validator']);

#Insurance Companies Search
$app
    ->get('/api/v1/search/insurance-companies', \Absalon\Application\PatientCard\Search\Actions\SearchInsuranceCompaniesAction::class)
    ->lazyMiddleware(['auth', 'search-string-validator']);

#MedicalDocuments
$app
    ->get('/api/v1/documents/forms/{id:uuid}', \Absalon\Application\MedicalDocuments\Actions\MedicalFormShowAction::class)
    ->lazyMiddleware('auth');

#Authentication
$app->get('/api/v1/auth/doAuth', \Absalon\Engine\AAIS\Actions\AuthenticateAction::class)
    ->lazyMiddleware('credentials-validator');
$app->get('/api/v1/auth/doRefresh', \Absalon\Engine\AAIS\Actions\RefreshAction::class)
    ->lazyMiddleware('refresh-token-validator');

#Fluorography
$app->get('/api/v1/fluorographies/{id:uuid}', \Absalon\Application\Fluorography\Actions\FluorographiesGetAction::class)
    ->lazyMiddleware('auth');
$app->get('/api/v1/fluorography/options', \Absalon\Application\Fluorography\Actions\FluorographyOptionsGetAction::class)
    ->lazyMiddleware('auth');
$app->post('/api/v1/fluorographies', \Absalon\Application\Fluorography\Actions\FluorographyCreateAction::class)
    ->lazyMiddleware(['auth', 'fluorography-fields-validator', 'fluorography-create']);
$app->put('/api/v1/fluorographies', \Absalon\Application\Fluorography\Actions\FluorographyUpdateAction::class)
    ->lazyMiddleware(['auth', 'fluorography-fields-validator', 'fluorography-update']);
$app->delete('/api/v1/fluorographies', \Absalon\Application\Fluorography\Actions\FluorographyDeleteAction::class)
    ->lazyMiddleware('auth');

#Vaccinations
$app->get('/api/v1/vaccinations/{id:uuid}', \Absalon\Application\Vaccinations\Actions\VaccinationsGetAction::class)
    ->lazyMiddleware('auth');
$app->get('/api/v1/vaccination/options', \Absalon\Application\Vaccinations\Actions\VaccinationOptionsGetAction::class)
    ->lazyMiddleware('auth');
$app->post('/api/v1/vaccinations', \Absalon\Application\vaccinations\Actions\VaccinationCreateAction::class)
    ->lazyMiddleware(['auth', 'vaccination-fields-validator', 'vaccination-create']);
$app->put('/api/v1/vaccinations', \Absalon\Application\Vaccinations\Actions\VaccinationUpdateAction::class)
    ->lazyMiddleware(['auth', 'vaccination-fields-validator', 'vaccination-update']);
$app->delete('/api/v1/vaccinations', \Absalon\Application\Vaccinations\Actions\VaccinationDeleteAction::class)
    ->lazyMiddleware('auth');

#Addresses
$app->get('/api/v1/addresses/{id:uuid}', \Absalon\Application\PatientCard\Addresses\Actions\AddressesGetAction::class)
    ->lazyMiddleware('auth');
$app->post('/api/v1/addresses', \Absalon\Application\PatientCard\Addresses\Actions\AddressCreateAction::class)
    ->lazyMiddleware('auth');
$app->put('/api/v1/addresses', \Absalon\Application\PatientCard\Addresses\Actions\AddressUpdateAction::class)
    ->lazyMiddleware('auth');

#Addresses Search
$app->get('/api/v1/addresses/search', \Absalon\Application\PatientCard\Addresses\Actions\AddressSearchAction::class)
    ->lazyMiddleware(['auth', 'search-string-validator']);

#Fluorography Reports
$app->get('/api/v1/report/fluorography/past-patients', \Absalon\Application\Reports\Fluorography\Actions\FluorographyGetPastPatientsAction::class)
    ->lazyMiddleware('auth');