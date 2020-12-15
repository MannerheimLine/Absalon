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
    //region PHP STORM REGION: PROPERTIES
    const MALE = 1;
    const FEMALE = 2;
    private int $_id = 0;                       // id карты в БД
    private int $_cardNumber;                   // [!!!] номер карты в картотеке, не уникален ввиду рукожопости персонала
    private string $_surname;                   // [!!!] фамилия
    private string $_firstName;                 // [!!!] имя
    private string|null $_secondName = null;    // отчество
    private int $_gender = 1;                   // 1-м, 2-ж
    private string|null $_dateBirth = null;     // дата рождения
    private string|null $_phone = null;                // номер телефона
    private string|null $_email = null;                     // адрес электронной почты
    private int $_policyNumber;                 // [!!!] номер полиса
    private int|null $_insuranceCompanyId = null;           // id страховой компании, для поиска в клиенте
    private string|null $_insuranceCompanyName = null;      // имя страховой компании для отображения
    private int $_insuranceCertificate;      // [!!!] СНИЛС
    private int|null $_passportSerial = null;               // серия  паспорта
                                                // должен делать првоерку что оно int, перед вставкой в БД конвертить в стринг
    private int|null $_passportNumber = null;               // номер паспорта
    private string|null $_fmsDepartment = null;             // отдел УФМС выдавший паспорт
    private string|null $_birthCertificateSerial = null;    // серия свидетельства о рождении
                                                // III-AB одна римская цифра, тире, две русских буквы
    private int|null $_birthCertificateNumber = null;       // номер сертифката, 6 цифр
    private string|null $_registryOffice = null;                   // отдел ЗАГС выдавший свидетельство
    private int $_regionId;                     // id региона
    private string $_region;                    // название региона
    private int $_districtId;                   // id района
    private string $_district;                  // название района
    private int $_localityId;                   // id населенного пункта
    private string $_locality;                  // название населенного пункта
    private int $_streetId;                     // id улицы
    private string $_street;                    // название улицы
    private string $_houseNumber;               // номер дома, может быть с содержанием буквы, 45B
    private int $_apartment;                    // номер квартиры
    private string $_workplace;                 // место работы, заносится от руки
    private string $_profession;                // профессия
    private string $_notation;                  // любой комментарий
    //endregion

    public function __construct
    (
        int $cardNumber,
        string $surname,
        string $firstname,
        int $policyNumber,
        int $insuranceCertificate
    )
    {
        $this->_cardNumber = $cardNumber;
        $this->_surname = $surname;
        $this->_firstName = $firstname;
        $this->_policyNumber = $policyNumber;
        $this->_insuranceCertificate = $insuranceCertificate;
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
            'PolicyNumber' => $this->_policyNumber,
            'InsuranceCertificate' => $this->_insuranceCertificate
        ];
    }
}