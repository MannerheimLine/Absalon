<?php


namespace Absalon\Application\PatientCard\Addresses\Domains\DataProviders;


interface IAddressSearchDataProvider
{
    public function getRegions(string $word, int $limit) : array;

    public function getDistricts(string $word, int $limit) : array;

    public function getLocalities(string $word, int $limit) : array;

    public function getStreets(string $word, int $limit) : array;
}