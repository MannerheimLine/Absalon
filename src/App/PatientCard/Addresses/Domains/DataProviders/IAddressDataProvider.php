<?php


namespace Absalon\Application\PatientCard\Addresses\Domains\DataProviders;


use Absalon\Application\PatientCard\Addresses\Domains\DataStructures\Address;

interface IAddressDataProvider
{
    public function get(string $id) : array;

    public function create(Address $address) : bool;

    public function update(Address $address) : bool;

    public function delete(array $ids) : bool;
}