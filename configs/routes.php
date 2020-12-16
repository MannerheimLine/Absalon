<?php
/** @noinspection PhpParamsInspection */
/**
 * Examples of the routes
 *
 * $app->get('card.get', '/patient-cards/{id}', \Vulpix\Application\PatientCard\Card\Actions\CardGetAction::class)->tokens(['id' => '\d+']);
 * $app->route('card.get', '/patient-cards/{id}', \Vulpix\Application\PatientCard\Card\Actions\CardGetAction::class, 'GET')->tokens(['id' => '\d+']);
 */

$app->get('card.get', '/card/{id}', \Absalon\Application\PatientCard\Card\Actions\CardGetAction::class)->tokens(['id' => '[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}']);
