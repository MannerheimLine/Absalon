<?php


namespace Absalon\Application\Fluorography\Domains;


interface IFluorographyDataProvider
{
    public function getAll(string $id) : array;

    public function getOptions() : array;

    public function create(FluorographyCreateDTO $DTO) : bool;

    public function update(string $id);
}