<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Authentication;

use Absalon\Engine\Exceptions\UnknownPropertyException;

class Credentials
{
    private string $_userName;
    private string $_userPassword;

    public function __construct() {
        parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $output);
        $this->_userName = $output['UserName'];
        $this->_userPassword = $output['UserPassword'];
    }

    public function __get($name)
    {
        if (property_exists($this, $property ='_'.$name)){
            return $this->$property;
        }
        throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
    }

}