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

    public static function mbUcFirst(string $string) : string
    {
        return mb_strtoupper(mb_substr($string, 0, 1)).mb_substr($string, 1);
    }

    public static function camelize(string $input, string $separator = '_') : string
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}