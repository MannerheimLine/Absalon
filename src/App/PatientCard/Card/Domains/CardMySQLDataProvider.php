<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

use PDO;
use Vulpix\Engine\Database\Connectors\IConnector;

/**
 * Класс для работы с чистым SQL.
 *
 * Class CardMySQLDataProvider
 * @package Absalon\Application\PatientCard\Card\Domains
 */
class CardMySQLDataProvider implements ICardDataProvider
{
    private PDO $_connection;

    /**
     * CardMySQLDataProvider constructor.
     * @param IConnector $connector
     */
    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    /**
     * @param string $id
     * @return Card
     */
    public function get(string $id) : array
    {
        $query = ("SELECT `patient_cards`.`id` AS `cardId`, `card_number` AS `cardNumber`, `surname` AS `surname`, 
                `first_name` AS `firstName`, `second_name` AS `secondName`, `gender`, `date_birth` AS `dateBirth`,
                `phone`, `email`, `policy_number` AS `policyNumber`, `insurance_company_id` AS `insuranceCompanyId`,
                `insurance_company_name` AS `insuranceCompanyName`, `insurance_certificate` AS `insuranceCertificate`,
                `passport_serial` AS `passportSerial`, `passport_number` AS `passportNumber`, `fms_department` AS `fmsDepartment`,
                `birth_certificate_serial` AS `birthCertificateSerial`, `birth_certificate_number` AS `birthCertificateNumber`,
                `registry_office` AS `registryOffice`, `region_id` AS `regionId`, `region_name` AS `regionName`,
                `district_id` AS `districtId`, `district_name` AS `districtName`, `locality_id` AS `localityId`,
                `locality_name` AS `localityName`, `street_id` AS `streetId`, `street_name` AS `streetName`,
                `house_number` AS `houseNumber`, `apartment`, `workplace`, `profession`, `notation`,
                `insurance_company_id` AS `insuranceCompanyId`, `insurance_company_name` AS `insuranceCompanyName`
                FROM `patient_cards`
                LEFT JOIN `regions` ON `patient_cards`.`region_id` = `regions`.`id` 
                LEFT JOIN `districts` ON `patient_cards`.`district_id` = `districts`.`id` 
                LEFT JOIN `localities` ON `patient_cards`.`locality_id` = `localities`.`id` 
                LEFT JOIN `streets` ON `patient_cards`.`street_id` = `streets`.`id`     
                LEFT JOIN `insurance_companies` ON `patient_cards`.`insurance_company_id` = `insurance_companies`.`id` 
                WHERE `patient_cards`.`id` = :id");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $id]);
        return $result->fetch() ?: [];
    }

    public function create(CardCreateDTO $dto): string
    {
        $query = ("INSERT INTO `patient_cards` (`id`, `card_number`, `surname`, `first_name`, `gender`, `date_birth`, 
                   `policy_number`, `insurance_certificate`)
                   
                   VALUES (:cardId, :cardNumber, :surname, :firstName, :gender, :dateBirth, :policyNumber, 
                   :insuranceCertificate)");
        $result = $this->_connection->prepare($query);

        $result->execute([
            'cardId' => $dto->cardId,
            'cardNumber' => $dto->cardNumber,
            'surname' => $dto->surname,
            'firstName' => $dto->firstName,
            'gender' => $dto->gender,
            'dateBirth' => $dto->dateBirth,
            'policyNumber' => $dto->policyNumber,
            'insuranceCertificate' => $dto->insuranceCertificate
        ]);
        return $dto->cardId;
    }
}