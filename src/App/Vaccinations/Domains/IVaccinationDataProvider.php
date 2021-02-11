<?php


namespace Absalon\Application\Vaccinations\Domains;


interface IVaccinationDataProvider
{
    public function getAll(string $id) : array;

    public function getOptions() : array;

    public function create(Vaccination $vaccination) : bool;

    public function update(Vaccination $vaccination) : bool;

    public function delete(string $ids) : bool;

}