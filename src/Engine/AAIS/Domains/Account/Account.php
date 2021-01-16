<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Account;

use Absalon\Engine\Exceptions\UnknownPropertyException;

class Account
{
    private string|null $_accountId = null;
    private string|null $_userName = null;
    private string|null $_passwordHash = null;
    private string|null $_secretKey = null;
    private string|null $_email = null;
    private string|null $_created = null;
    private string|null $_updated = null;

    public function __get($name){
        if (property_exists($this, $property ='_'.$name)){
            return $this->$property;
        }
        throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
    }
    public function __set($name, $value){
        if (property_exists($this, $property ='_'.($name))){
            $this->$property = $value;
        }else{
            throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
        }
    }

}