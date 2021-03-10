<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Domains\Services;

use Absalon\Engine\Utility\Assert\Assert;

class DataConverter
{
    public static function getConvertedDate(string|null $date) : string|null
    {
        if (Assert::IsNotEmptyAndNull($date)){
            return date("d.m.Y", strtotime($date));
        }
        return null;
    }

    public static function getFullPassport(string|null $passportSerial, string|null $passportNumber) : string|null
    {
        if (Assert::IsNotEmptyAndNull($passportSerial) && Assert::IsNotEmptyAndNull($passportNumber)){
            return $passportSerial.' '.$passportNumber;
        }
        return null;
    }

    public static function getInsuranceCertificate(string|null $insuranceCertificate) : string|null
    {
        if (Assert::IsNotEmptyAndNull($insuranceCertificate))
        {
            $splited = str_split($insuranceCertificate, 3);
            return implode('-', array_splice($splited, 0 ,3)).' '.$splited[0];
        }
        return null;
    }

    public static function getPolicyNumber(string|null $policyNumber, string|null $temporaryPolicyNumber) : string|null
    {
        if (Assert::IsNotEmptyAndNull($policyNumber)){
            return implode('-', str_split($policyNumber, 4));
        }elseif (Assert::IsNotEmptyAndNull($temporaryPolicyNumber)){
            return implode('-', str_split($temporaryPolicyNumber, 3));
        }else{
            return null;
        }

    }

    public static function getFullAddress(array $address) : string|null
    {
        if (Assert::IsNotEmptyAndNull($address)){
            if (Assert::IsNotEmptyAndNull($address['regionName'])){
                $region = $address['regionName'];
            }else{
                $region = null;
            }
            if (Assert::IsNotEmptyAndNull($address['districtName'])){
                $district = ', '.$address['districtName'];
            }else{
                $district = null;
            }
            if (Assert::IsNotEmptyAndNull($address['localityPrefix'])){
                $localityPrefix = ', '.$address['localityPrefix'];
            }else{
                $localityPrefix = null;
            }
            if (Assert::IsNotEmptyAndNull($address['localityName'])){
                $localityName = ' '.$address['localityName'];
            }else{
                $localityName = null;
            }
            if (Assert::IsNotEmptyAndNull($address['streetPrefix'])){
                $streetPrefix = ', '.$address['streetPrefix'];
            }else{
                $streetPrefix = null;
            }
            if (Assert::IsNotEmptyAndNull($address['streetName'])){
                $streetName = ' '.$address['streetName'];
            }else{
                $streetName = null;
            }
            if (Assert::IsNotEmptyAndNull($address['houseNumber'])){
                $houseNumber = ', дом '.$address['houseNumber'];
            }else{
                $houseNumber = null;
            }
            if (Assert::IsNotEmptyAndNull($address['apartment'])){
                $apartment = ', квартира '.$address['apartment'];
            }else{
                $apartment = null;
            }
            return $region.$district.$localityPrefix.$localityName.$streetPrefix.$streetName.$houseNumber.$apartment;
        }
        return null;
    }

    public static function getInsuranceCompany(string|null $insurerCode, string|null $insuranceCompanyName) : string|null
    {
        if (Assert::IsNotEmptyAndNull($insurerCode) && Assert::IsNotEmptyAndNull($insuranceCompanyName)){
            return $insurerCode.'-'.$insuranceCompanyName;
        }
        return null;
    }

    public static function getValueOrNull(string|null $value) : string|null
    {
        if(Assert::IsNotEmptyAndNull($value)){
            return $value;
        }
        return null;
    }
}