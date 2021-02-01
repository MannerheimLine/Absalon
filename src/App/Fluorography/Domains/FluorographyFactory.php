<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Domains;

class FluorographyFactory
{
    public static function create(array $data) : Fluorography
    {
        $fluorography = new Fluorography();
        if($data){
            foreach ($data as $name => $value){
                $fluorography->$name = $value;
            }
        }
        return $fluorography;
    }

}