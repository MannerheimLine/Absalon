<?php

declare(strict_types=1);

namespace Absalon\Engine\Utility\Assert;

class Assert
{
    public static function uuid(string $value) : bool{
        if (preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i', $value)) {
            return true;
        }
        throw new \InvalidArgumentException('Значение переданное аргументом не является UUID');
    }
}