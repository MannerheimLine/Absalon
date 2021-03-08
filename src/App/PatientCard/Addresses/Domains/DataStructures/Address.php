<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Domains\DataStructures;

use Absalon\Engine\Exceptions\UnknownPropertyException;

class Address implements \JsonSerializable
{
    private string|null $_addressId;
    private string|null $_patientCardId;
    private string|null $_addressTypeId;
    private string|null $_addressTypeName;
    private string|null $_addressTypeSystemName;
    private string|null $_regionId;
    private string|null $_regionName;
    private string|null $_districtId;
    private string|null $_districtName;
    private string|null $_localityId;
    private string|null $_localityName;
    private string|null $_streetId;
    private string|null $_streetName;
    private string|null $_houseNumber;
    private string|null $_apartment;

    /**
     * @param $name
     * @return mixed
     * @throws UnknownPropertyException
     */
    public function __get($name){
        if (property_exists($this, $property ='_'.$name)){
            return $this->$property;
        }
        throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
    }

    /**
     * @param $name
     * @param $value
     * @throws UnknownPropertyException
     */
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
            'AddressId' => $this->_addressId,
            'PatientCardId' => $this->_patientCardId,
            'AddressTypeId' => $this->_addressTypeId,
            'AddressTypeName' => $this->_addressTypeName,
            'AddressTypeSystemName' => $this->_addressTypeSystemName,
            'RegionId' => $this->_regionId,
            'RegionName' => $this->_regionName,
            'DistrictId' => $this->_districtId,
            'DistrictName' => $this->_districtName,
            'LocalityId' => $this->_localityId,
            'LocalityName' => $this->_localityName,
            'StreetId' => $this->_streetId,
            'StreetName' => $this->_streetName,
            'HouseNumber' => $this->_houseNumber,
            'Apartment' => $this->_apartment
        ];
    }
}