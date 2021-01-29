<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

use Absalon\Engine\Exceptions\UnknownPropertyException;
use Ramsey\Uuid\Uuid;
use function Ramsey\Uuid\v4;

/**
 * Класс используется для передачи данных от клиента. Содержит информацию по полям на основе которых нужно создать
 * карту. используется в методе CardManager::create()
 * Так как DTO не должен содержать логику, а желания держать публичные свойства тоже нет.
 * Реализовал приватные свойства и доступ к ним, через __get
 *
 * Class CardCreateDTO
 * @package Absalon\Application\PatientCard\Card\Domains
 */
class CardCreateDTO
{
    private string $_cardId;
    private int $_cardNumber;
    private string $_surname;
    private string $_firstName;
    private int $_gender;
    private string $_dateBirth;
    private string $_policyNumber;
    private string $_insuranceCertificate;

    public function __construct(array $data){
        $this->_cardId = Uuid::uuid4()->toString();
        foreach ($data as $key => $value){
            if (property_exists($this, $property ='_'.lcfirst($key))){
                $this->$property = $value;
            }
        }
    }

    public function __get($name){
        if (property_exists($this, $property ='_'.$name)){
            return $this->$property;
        }
        throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
    }

}