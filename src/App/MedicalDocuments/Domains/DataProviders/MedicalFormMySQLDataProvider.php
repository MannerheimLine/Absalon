<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Domains\DataProviders;

use PDO;
use Vulpix\Engine\Database\Connectors\IConnector;

class MedicalFormMySQLDataProvider implements IMedicalFormDataProvider
{
    private PDO $_connection;

    public function __construct(IConnector $connector)
    {
        $this->_connection = $connector::getConnection();
    }

    public function getCard(string $cardId) : array
    {
        $query = ("SELECT `patient_cards`.`id` AS `cardId`,`patient_cards`.`card_number` AS `cardNumber`, 
       `patient_cards`.`surname` AS `surname`, `patient_cards`.`first_name` AS `firstName`, `patient_cards`.`second_name` AS `secondName`, 
       `genders`.`description` AS `genderDescription`, `patient_cards`.`insurance_certificate` AS `insuranceCertificate`, 
       `patient_cards`.`date_birth` AS `dateBirth`, `patient_cards`.`policy_number` AS `policyNumber`, 
       `patient_cards`.`temporary_policy_number` AS `temporaryPolicyNumber`, `insurance_companies`.`insurance_company_name` AS insuranceCompanyName, 
       `insurance_companies`.`insurer_code` AS `insurerCode`, `patient_cards`.`passport_serial` AS `passportSerial`, 
       `patient_cards`.`passport_number` AS `passportNumber`, `patient_cards`.`passport_date_of_issue` AS `passportDateOfIssue`,
       `patient_cards`.`fms_department` AS `fmsDepartment`, `patient_cards`.`birth_certificate_serial` AS `birthCertificateSerial`, 
       `patient_cards`.`birth_certificate_number` AS `birthCertificateNumber`, 
       `patient_cards`.`birth_certificate_date_of_issue` AS `birthCertificateDateOfIssue`,
       `patient_cards`.`registry_office` AS `registryOffice`, `patient_cards`.`workplace` AS `workplace`, 
       `patient_cards`.`profession` AS `profession`
       FROM `patient_cards` 
       LEFT JOIN `genders` ON `patient_cards`.`gender` = `genders`.`id`
       LEFT JOIN `insurance_companies` ON `patient_cards`.`insurance_company_id` = `insurance_companies`.`id`
       WHERE `patient_cards`.`id` = :id");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $cardId]);
        return $result->fetch() ?: [];
    }

    public function getAddress(string $cardId) : array
    {
        $query = ("SELECT r.region_name AS regionName, d.district_name AS districtName, 
                   l.locality_prefix AS localityPrefix, l.locality_name AS localityName, 
                   s.street_prefix AS streetPrefix, s.street_name AS streetName, house_number AS houseNumber, apartment
                   FROM patient_cards_addresses pca
                   LEFT JOIN regions r on r.region_id = pca.region
                   LEFT JOIN districts d on d.district_id = pca.district
                   LEFT JOIN localities l on l.locality_id = pca.locality
                   LEFT JOIN streets s on pca.street = s.street_id
                   WHERE patient_card = :cardId");
        $result = $this->_connection->prepare($query);
        $result->execute(['cardId' => $cardId]);
        return $result->fetch() ?: [];
    }
}