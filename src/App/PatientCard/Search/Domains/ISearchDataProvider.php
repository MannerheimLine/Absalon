<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Domains;

interface ISearchDataProvider
{
    public function getCards(string $word, int $start, int $offset) : array;

    public function getRegions(string $word, int $limit) : array;

    public function getDistricts(string $word, int $limit) : array;

    public function getLocalities(string $word, int $limit) : array;

    public function getStreets(string $word, int $limit) : array;
}