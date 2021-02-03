<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Domains;

use Absalon\Engine\Exceptions\UnknownPropertyException;
use Ramsey\Uuid\Uuid;

class FluorographyCreateDTO
{
    private string $_fluorographyId;
    private string $_patientCard;
    private string $_date;
    private string|null $_number;
    private string|null $_notation;
    private int|null $_snapshot;
    private int $_type;
    private int|null $_dose;
    private int $_result;
    private int|null $_sender;

    public function __construct(array $data)
    {
        $this->_fluorographyId = Uuid::uuid4()->toString();
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