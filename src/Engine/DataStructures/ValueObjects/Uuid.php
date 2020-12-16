<?php

declare(strict_types=1);

namespace Absalon\Engine\DataStructures\ValueObjects;

use Absalon\Engine\Utility\Assert\Assert;

class Uuid
{
    private $_value;

    public function __construct(string $value){
        Assert::uuid($value);
        $this->_value = $value;
    }

    public function getValue() : string
    {
        return $this->_value;
    }
}