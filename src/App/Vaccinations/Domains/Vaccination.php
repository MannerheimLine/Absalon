<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Domains;

use Absalon\Engine\Exceptions\UnknownPropertyException;

class Vaccination implements \JsonSerializable
{
    private string|null $_vaccinationId;
    private string|null $_patientCardId;
    private string|null $_vaccinationDate;
    private string|null $_vaccinationSerial;
    private string|null  $_vaccinationNotation;
    private int|null $_vaccinationTypeId;
    private string|null $_vaccinationTypeName;
    private int|null $_vaccinationDoseId;
    private string|null $_vaccinationDoseName;
    private int|null $_vaccinationInjectionId;
    private string|null $_vaccinationInjectionName;
    private int|null $_vaccinationDivertId;
    private string|null$_vaccinationDivertName;

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
            'VaccinationId' => $this->_vaccinationId,
            'PatientCardId' => $this->_patientCardId,
            'VaccinationDate' => $this->_vaccinationDate,
            'VaccinationSerial' => $this->_vaccinationSerial,
            'VaccinationNotation' => $this->_vaccinationNotation,
            'VaccinationTypeId' => $this->_vaccinationTypeId,
            'VaccinationTypeName' => $this->_vaccinationTypeName,
            'VaccinationDoseId' => $this->_vaccinationDoseId,
            'VaccinationDoseName' => $this->_vaccinationDoseName,
            'VaccinationInjectionId' => $this->_vaccinationInjectionId,
            'VaccinationInjectionName' => $this->_vaccinationInjectionName,
            'VaccinationDivertId' => $this->_vaccinationDivertId,
            'VaccinationDivertName' => $this->_vaccinationDivertName
        ];
    }
}