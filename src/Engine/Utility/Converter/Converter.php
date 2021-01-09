<?php

declare(strict_types=1);

namespace Absalon\Engine\Utility\Converter;

class Converter
{
    /**
     * Ковертирует массив в строку пригодну для вставки в БД, методом перебора
     * Для операторов типа IN
     *
     * @param array $array
     * @return string
     */
    public static function arrayToQuotedString(array $array) : string
    {
        $string = '';
        foreach ($array as $key => $value){
            $string .= "'".$value."', ";
        }
        return mb_substr($string, 0, -2);
    }

}