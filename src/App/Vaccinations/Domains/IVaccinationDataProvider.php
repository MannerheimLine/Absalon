<?php


namespace Absalon\Application\Vaccinations\Domains;


interface IVaccinationDataProvider
{
    public function getAll(string $id) : array;

    public function getOptions() : array;

}