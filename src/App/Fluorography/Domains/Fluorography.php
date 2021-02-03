<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Domains;

use Absalon\Engine\Exceptions\UnknownPropertyException;

class Fluorography implements \JsonSerializable
{
    private string $_fluorographyId;
    private string $_patientCardId;
    private int $_fluorographyTypeId;
    private string $_fluorographyTypeName;
    private int|null $_fluorographyDoseId;
    private string|null $_fluorographyDoseName;
    private int $_fluorographyResultId;
    private string $_fluorographyResultName;
    private string|null $_fluorographyNumber;
    private int|null $_fluorographySnapshot;
    private string $_fluorographyDate;
    private int|null $_fluorographySenderId;
    private string|null $_fluorographySenderName;
    private string|null $_fluorographyNotation;

    public function __get($name){
        if (property_exists($this, $property ='_'.$name)){
            return $this->$property;
        }
        throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
    }

    public function __set($name, $value){
        if (property_exists($this, $property ='_'.lcfirst($name))){
            $this->$property = $value;
        }else{
            throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
        }
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        return [
            'FluorographyId' => $this->_fluorographyId,
            'PatientCardId' => $this->_patientCardId,
            'FluorographyTypeId' => $this->_fluorographyTypeId,
            'FluorographyTypeName' => $this->_fluorographyTypeName,
            'FluorographyDoseId' => $this->_fluorographyDoseId,
            'FluorographyDoseName' => $this->_fluorographyDoseName,
            'FluorographyResultId' => $this->_fluorographyResultId,
            'FluorographyResultName' => $this->_fluorographyResultName,
            'FluorographyNumber' => $this->_fluorographyNumber,
            'FluorographySnapshot' => $this->_fluorographySnapshot,
            'FluorographyDate' => $this->_fluorographyDate,
            'FluorographySenderId' => $this->_fluorographySenderId,
            'FluorographySenderName' => $this->_fluorographySenderName,
            'FluorographyNotation' => $this->_fluorographyNotation
        ];
    }
}