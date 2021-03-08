<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Domains;

use Absalon\Application\PatientCard\Addresses\Domains\DataStructures\Address;

class AddressesFactory
{
    public static function create(array $addresses) : array
    {
        $addressesArray = [];
        if(!empty($addresses)){
            foreach ($addresses as $single){
                $address = new Address();
                $systemName = $single['addressTypeSystemName'];
                foreach ($single AS $name => $value){
                    $address->$name = $value;
                }
                $addressesArray[$systemName] = $address;
            }
        }
        return $addressesArray;
    }

    public static function createDTO(array $data) : Address
    {
        $address = new Address();
        if($data){
            foreach ($data as $name => $value){
                $address->$name = $value;
            }
        }
        return $address;
    }
}