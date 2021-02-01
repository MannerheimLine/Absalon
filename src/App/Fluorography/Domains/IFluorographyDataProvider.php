<?php


namespace Absalon\Application\Fluorography\Domains;


interface IFluorographyDataProvider
{
    public function getAll(string $id) : array;

    public function create();

    public function update(string $id);
}