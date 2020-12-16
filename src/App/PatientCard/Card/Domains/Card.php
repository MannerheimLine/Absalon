<?php

declare(strict_types = 1);

namespace Absalon\Application\PatientCard\Card\Domains;

/**
 * Entity, которая содержит всю информацию о карте пациента
 *
 * Class Card
 * @package Absalon\Application\PatientCard\Card\Domains
 */
class Card implements \JsonSerializable
{
    #region PHP STORM REGION: PROPERTIES
    private string $_id;                            // [!!!] id карты в БД
    private int $_cardNumber;                       // [!!!] номер карты в картотеке, не уникален ввиду рукожопости персонала
    private string $_surname;                       // [!!!] фамилия
    private string $_firstName;                     // [!!!] имя
    private string|null $_secondName;               // отчество
    private int $_gender;                           // [!!!] 1-м, 2-ж
    private string $_dateBirth;                     // [!!!] дата рождения
    private string|null $_phone;                    // номер телефона
    private string|null $_email;                    // адрес электронной почты
    private int $_policyNumber;                     // [!!!] номер полиса
    private int|null $_insuranceCompanyId;          // id страховой компании, для поиска в клиенте
    private string|null $_insuranceCompanyName;     // имя страховой компании для отображения
    private int $_insuranceCertificate;             // [!!!] СНИЛС
    private int|null $_passportSerial;              // серия  паспорта
                                                    // должен делать првоерку что оно int, перед вставкой в БД конвертить в стринг
    private int|null $_passportNumber;              // номер паспорта
    private string|null $_fmsDepartment;            // отдел УФМС выдавший паспорт
    private string|null $_birthCertificateSerial;   // серия свидетельства о рождении
                                                    // III-AB одна римская цифра, тире, две русских буквы
    private int|null $_birthCertificateNumber;      // номер сертифката, 6 цифр
    private string|null $_registryOffice;           // отдел ЗАГС выдавший свидетельство
    private int|null $_regionId;                    // id региона
    private string|null $_regionName;               // название региона
    private int|null $_districtId;                  // id района
    private string|null $_districtName;             // название района
    private int|null $_localityId;                  // id населенного пункта
    private string|null $_localityName;             // название населенного пункта
    private int|null $_streetId;                    // id улицы
    private string|null $_streetName;               // название улицы
    private string|null $_houseNumber;              // номер дома, может быть с содержанием буквы, 45B
    private int|null $_apartment;                   // номер квартиры
    private string|null $_workplace;                // место работы, заносится от руки
    private string|null $_profession;               // профессия
    private string|null $_notation;                 // любой комментарий
    #endregion
    public function __construct
    (
        string $id,
        int $cardNumber,
        string $surname,
        string $firstName,
        string|null $secondName,
        int $gender,
        string $dateBirth,
        string|null $phone,
        string|null $email,
        int $policyNumber,
        int|null $insuranceCompanyId,
        string|null $insuranceCompanyName,
        int $insuranceCertificate,
        int|null $passportSerial,
        int|null $passportNumber,
        string|null $fmsDepartment,
        string|null $birthCertificateSerial,
        int|null $birthCertificateNumber,
        string|null $registryOffice,
        int|null $regionId,
        string|null $regionName,
        int|null $districtId,
        string|null $districtName,
        int|null $localityId,
        string|null $localityName,
        int|null $streetId,
        string|null $streetName,
        string|null $houseNumber,
        int|null $apartment,
        string|null $workplace,
        string|null $profession,
        string|null $notation
    )
    {
        $this->_id = $id;
        $this->_cardNumber = $cardNumber;
        $this->_surname = $surname;
        $this->_firstName = $firstName;
        $this->_secondName = $secondName;
        $this->_gender = $gender;
        $this->_dateBirth = $dateBirth;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_policyNumber = $policyNumber;
        $this->_insuranceCompanyId = $insuranceCompanyId;
        $this->_insuranceCompanyName = $insuranceCompanyName;
        $this->_insuranceCertificate = $insuranceCertificate;
        $this->_passportSerial = $passportSerial;
        $this->_passportNumber = $passportNumber;
        $this->_fmsDepartment = $fmsDepartment;
        $this->_birthCertificateSerial = $birthCertificateSerial;
        $this->_birthCertificateNumber = $birthCertificateNumber;
        $this->_registryOffice = $registryOffice;
        $this->_regionId = $regionId;
        $this->_regionName = $regionName;
        $this->_districtId = $districtId;
        $this->_districtName = $districtName;
        $this->_localityId = $localityId;
        $this->_localityName = $localityName;
        $this->_streetId = $streetId;
        $this->_streetName = $streetName;
        $this->_houseNumber = $houseNumber;
        $this->_apartment = $apartment;
        $this->_workplace = $workplace;
        $this->_profession = $profession;
        $this->_notation = $notation;
    }

    public function jsonSerialize()
    {
        return [
            'Id' => $this->_id,
            'CardNumber' => $this->_cardNumber,
            'Surname' => $this->_surname,
            'FirstName' => $this->_firstName,
            'SecondName' => $this->_secondName,
            'Gender' => $this->_gender,
            'DateBirth' => $this->_dateBirth,
            'PhoneNumber' => $this->_phone,
            'Email' => $this->_email,
            'PolicyNumber' => $this->_policyNumber,
            'InsuranceCompanyId' => $this->_insuranceCompanyId,
            'InsuranceCompanyName' => $this->_insuranceCompanyName,
            'InsuranceCertificate' => $this->_insuranceCertificate,
            'PassportSerial' => $this->_passportSerial,
            'PassportNumber' => $this->_passportNumber,
            'FmsDepartment' => $this->_fmsDepartment,
            'BirthCertificateSerial' => $this->_birthCertificateSerial,
            'BirthCertificateNumber' => $this->_birthCertificateNumber,
            'RegistryOffice' => $this->_registryOffice,
            'RegionId' => $this->_regionId,
            'RegionName' => $this->_regionName,
            'DistrictId' => $this->_districtId,
            'DistrictName' => $this->_districtName,
            'LocalityId' => $this->_localityId,
            'LocalityName' => $this->_localityName,
            'StreetId' => $this->_streetId,
            'StreetName' => $this->_streetName,
            'Apartment' => $this->_apartment,
            'Workplace' => $this->_workplace,
            'Profession' => $this->_profession,
            'Notation' => $this->_notation
        ];
    }
}