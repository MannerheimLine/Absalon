<?php

declare(strict_types = 1);

namespace Absalon\Application\PatientCard\Card\Domains;

use Absalon\Application\PatientCard\Addresses\Domains\AddressesContainer;
use Absalon\Engine\Exceptions\UnknownPropertyException;

/**
 * Карта пациента
 *
 * Class Card
 * @package Absalon\Application\PatientCard\Card\Domains
 */
class Card implements \JsonSerializable
{
    #region PHP STORM REGION: PROPERTIES
    private string|null $_cardId = null;                   // [!!!] id карты в БД
    private int|null $_cardNumber = null;                  // [!!!] номер карты в картотеке, не уникален ввиду рукожопости персонала
    private string|null $_surname = null;                  // [!!!] фамилия
    private string|null $_firstName = null;                // [!!!] имя
    private string|null $_secondName = null;               // отчество
    private int|null $_gender = null;                      // [!!!] 1-м, 2-ж
    private string|null $_dateBirth = null;                // [!!!] дата рождения
    private string|null $_dateDeath = null;                // дата смерти
    private int|null $_isAlive = null;                     // статус жизни: 1- жив, 2 - мертв
    private string|null $_phoneNumber = null;              // номер телефона
    private string|null $_email = null;                    // адрес электронной почты
    private string|null $_policyNumber = null;             // [!!!] номер полиса
    private int|null $_insuranceCompanyId = null;          // id страховой компании, для поиска в клиенте
    private string|null $_insuranceCompanyName = null;     // имя страховой компании для отображения
    private string|null $_insuranceCertificate = null;     // [!!!] СНИЛС
    private string|null $_passportSerial = null;           // серия  паспорта
                                                           // должен делать првоерку что оно int, перед вставкой в БД конвертить в стринг
    private string|null $_passportNumber = null;           // номер паспорта
    private string|null $_passportDateOfIssue = null;           // номер паспорта
    private string|null $_fmsDepartment = null;            // отдел УФМС выдавший паспорт
    private string|null $_birthCertificateSerial = null;   // серия свидетельства о рождении
                                                           // III-AB одна римская цифра, тире, две русских буквы
    private string|null $_birthCertificateNumber = null;   // номер сертифката, 6 цифр
    private string|null $_birthCertificateDateOfIssue = null;   // номер сертифката, 6 цифр
    private string|null $_registryOffice = null;           // отдел ЗАГС выдавший свидетельство
    private string|null $_workplace = null;                // место работы, заносится от руки
    private string|null $_profession = null;               // профессия
    private string|null $_notation = null;                 // любой комментарий
    private string|null $_owner = null;                    // пользователь редактирующий текущую карту
    #endregion

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

    public function jsonSerialize()
    {
        return [
            'CardId' => $this->_cardId,
            'CardNumber' => $this->_cardNumber,
            'Surname' => $this->_surname,
            'FirstName' => $this->_firstName,
            'SecondName' => $this->_secondName,
            'Gender' => $this->_gender,
            'DateBirth' => $this->_dateBirth,
            'DateDeath' => $this->_dateDeath,
            'IsAlive' => $this->_isAlive,
            'PhoneNumber' => $this->_phoneNumber,
            'Email' => $this->_email,
            'PolicyNumber' => $this->_policyNumber,
            'InsuranceCompanyId' => $this->_insuranceCompanyId,
            'InsuranceCompanyName' => $this->_insuranceCompanyName,
            'InsuranceCertificate' => $this->_insuranceCertificate,
            'PassportSerial' => $this->_passportSerial,
            'PassportNumber' => $this->_passportNumber,
            'PassportDateOfIssue' => $this->_passportDateOfIssue,
            'FmsDepartment' => $this->_fmsDepartment,
            'BirthCertificateSerial' => $this->_birthCertificateSerial,
            'BirthCertificateNumber' => $this->_birthCertificateNumber,
            'BirthCertificateDateOfIssue' => $this->_birthCertificateDateOfIssue,
            'RegistryOffice' => $this->_registryOffice,
            'Workplace' => $this->_workplace,
            'Profession' => $this->_profession,
            'Notation' => $this->_notation,
            'Owner' => $this->_owner
        ];
    }
}