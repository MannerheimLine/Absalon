<?php


namespace Absalon\Application\Reports\Fluorography\Domains;


interface IFluorographyReportsDataProvider
{
    public function getPastPatients(string $dateStart, string $dateFinish) : array;
}