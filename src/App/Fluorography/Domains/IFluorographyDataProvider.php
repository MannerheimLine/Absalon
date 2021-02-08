<?php


namespace Absalon\Application\Fluorography\Domains;


interface IFluorographyDataProvider
{
    public function getAll(string $id) : array;

    public function getOptions() : array;

    public function create(Fluorography $fluororgraphy) : bool;

    public function update(Fluorography $fluororgraphy) : bool;

    public function delete(string $ids) : bool;
}