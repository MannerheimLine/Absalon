<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Domains;

class VaccinationFactory
{
    public static function create(array $data) : Vaccination
    {
        $vaccination = new Vaccination();
        if($data){
            foreach ($data as $name => $value){
                $vaccination->$name = $value;
            }
        }
        return $vaccination;
    }
}