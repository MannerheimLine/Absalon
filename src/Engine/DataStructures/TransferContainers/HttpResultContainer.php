<?php

declare(strict_types=1);

namespace Absalon\Engine\DataStructures\TransferContainers;

/**
 * Класс используется для передачи, данных, а так же http статуса который должен быть отправлен клиенту
 * вместе с этими данными.
 *
 * Может быть создан как натуровне Actions, так и на уровне Domains: особенно удобно при исползовании условных
 * операторов.
 *
 * Class HttpResultContainer
 * @package Absalon\Engine\DataStructures\TransferContainers
 */
class HttpResultContainer
{
    private $_body;         //Может содержать в себе, объект, либо данные любых типов
    private int $_status;   //Http статус, который будет отдаваться клиенту

    public function __construct($body = null, int $status = 204){
        $this->_body = $body;
        $this->_status = $status;
    }

    public function __get($name){
        if (property_exists($this, $property ='_'.$name)){
            return $this->$property;
        }
        //throw тут свое исключение о том что нет такого свойства и тд
    }

    public function __set($name, $value){
        if (property_exists($this, $property ='_'.$name)){
            $this->$property = $value;
        }
        //throw
    }

}