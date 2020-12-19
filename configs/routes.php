<?php
/** @noinspection PhpParamsInspection */
/**
 * Examples of the routes
 *
 * $app->get('card.get', '/patient-cards/{id}', \Vulpix\Application\PatientCard\Card\Actions\CardGetAction::class)->tokens(['id' => '\d+']);
 * $app->route('card.get', '/patient-cards/{id}', \Vulpix\Application\PatientCard\Card\Actions\CardGetAction::class, 'GET')->tokens(['id' => '\d+']);
 */

$app->get('card.get', '/cards/{id}', \Absalon\Application\PatientCard\Card\Actions\CardGetAction::class)->tokens(['id' => '[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}']);
$app->post('card.create', '/cards', \Absalon\Application\PatientCard\Card\Actions\CardCreateAction::class);
$app->put('card.update', '/cards', \Absalon\Application\PatientCard\Card\Actions\CardUpdateAction::class);
