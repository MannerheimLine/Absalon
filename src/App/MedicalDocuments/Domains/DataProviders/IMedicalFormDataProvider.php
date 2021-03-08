<?php


namespace Absalon\Application\MedicalDocuments\Domains\DataProviders;


interface IMedicalFormDataProvider
{
    public function getAddress(string $cardId) : array;

    public function getCard(string $cardId) : array;
}