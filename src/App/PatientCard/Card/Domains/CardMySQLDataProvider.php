<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

use DateTime;
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
                `date_death` AS `dateDeath`, `is_alive` AS `isAlive`, `phone_number` AS `phoneNumber`, `email`, 
                `policy_number` AS `policyNumber`, `insurance_company_id` AS `insuranceCompanyId`,
                `insurance_company_name` AS `insuranceCompanyName`, `insurance_certificate` AS `insuranceCertificate`,
                `passport_serial` AS `passportSerial`, `passport_number` AS `passportNumber`, 
                `passport_date_of_issue` AS `passportDateOfIssue`, `birth_certificate_date_of_issue` AS `birthCertificateDateOfIssue`,
                `fms_department` AS `fmsDepartment`, `birth_certificate_serial` AS `birthCertificateSerial`, 
                `birth_certificate_number` AS `birthCertificateNumber`, `registry_office` AS `registryOffice`, 
                `workplace`, `profession`, `notation`, `owner` AS `owner`
                FROM `patient_cards`
                LEFT JOIN `insurance_companies` ON `patient_cards`.`insurance_company_id` = `insurance_companies`.`id` 
                WHERE `patient_cards`.`id` = :id");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $id]);
        return $result->fetch() ?: [];
    }

    public function create(CardCreateDTO $dto): string
    {
        $query = ("INSERT INTO `patient_cards` (`id`, `card_number`, `surname`, `first_name`, `second_name`, `gender`, `date_birth`, 
                   `policy_number`, `insurance_certificate`)
                   VALUES (:cardId, :cardNumber, :surname, :firstName, :secondName, :gender, :dateBirth, :policyNumber, 
                   :insuranceCertificate)");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'cardId' => $dto->cardId,
            'cardNumber' => $dto->cardNumber,
            'surname' => $dto->surname,
            'firstName' => $dto->firstName,
            'secondName' => $dto->secondName,
            'gender' => $dto->gender,
            'dateBirth' => $dto->dateBirth,
            'policyNumber' => $dto->policyNumber,
            'insuranceCertificate' => $dto->insuranceCertificate
        ]);
        return $dto->cardId;
    }

    public function update(Card $card) : bool
    {
        /*$query = ("UPDATE `patient_cards`
                   SET 
                       `card_number` = :cardNumber,
                       `surname` = :surname,
                       `first_name` = :firstName,
                       `second_name` = :secondName,
                       `gender` = :gender,
                       `date_birth` = :dateBirth,
                       `phone_number` = :phoneNumber,
                       `email` = :email,
                       `policy_number` = :policyNumber,
                       `insurance_company_id` = :insuranceCompanyId,
                       `insurance_certificate` = :insuranceCertificate,
                       `passport_serial` = :passportSerial,
                       `passport_number` = :passportNumber,
                       `passport_date_of_issue` = :passportDateOfIssue,
                       `fms_department` =:fmsDepartment,
                       `birth_certificate_serial` = :birthCertificateSerial,
                       `birth_certificate_number` = :birthCertificateNumber,
                       `birth_certificate_date_of_issue` = :birthCertificateDateOfIssue,
                       `registry_office` = :registryOffice,
                       `region_id` = :regionId,
                       `district_id` = :districtId,
                       `locality_id` = :localityId,
                       `street_id` = :streetId,
                       `house_number` = :houseNumber,
                       `apartment` = :apartment,
                       `workplace` = :workplace,
                       `profession` = :profession,
                       `notation` = :notation,
                       `last_update` = :last_update
                   WHERE `id` = :cardId");*/
        $query = ("UPDATE `patient_cards` 
                   SET 
                       `card_number` = :cardNumber,
                       `surname` = :surname,
                       `first_name` = :firstName,
                       `second_name` = :secondName,
                       `gender` = :gender,
                       `date_birth` = :dateBirth,
                       `phone_number` = :phoneNumber,
                       `email` = :email,
                       `policy_number` = :policyNumber,
                       `insurance_company_id` = :insuranceCompanyId,
                       `insurance_certificate` = :insuranceCertificate,
                       `passport_serial` = :passportSerial,
                       `passport_number` = :passportNumber,
                       `passport_date_of_issue` = :passportDateOfIssue,
                       `fms_department` =:fmsDepartment,
                       `birth_certificate_serial` = :birthCertificateSerial,
                       `birth_certificate_number` = :birthCertificateNumber,
                       `birth_certificate_date_of_issue` = :birthCertificateDateOfIssue,
                       `registry_office` = :registryOffice,
                       `workplace` = :workplace,
                       `profession` = :profession,
                       `notation` = :notation,
                       `last_update` = :last_update
                   WHERE `id` = :cardId");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'cardId' => $card->cardId,
            'cardNumber' => $card->cardNumber,
            'surname' => $card->surname,
            'firstName' => $card->firstName,
            'secondName' => $card->secondName,
            'gender' => $card->gender,
            'dateBirth' => $card->dateBirth,
            'phoneNumber' => $card->phoneNumber,
            'email' => $card->email,
            'policyNumber' => $card->policyNumber,
            'insuranceCompanyId' => $card->insuranceCompanyId,
            'insuranceCertificate' => $card->insuranceCertificate,
            'passportSerial' => $card->passportSerial,
            'passportNumber' => $card->passportNumber,
            'passportDateOfIssue' => $card->passportDateOfIssue,
            'fmsDepartment' => $card->fmsDepartment,
            'birthCertificateSerial' => $card->birthCertificateSerial,
            'birthCertificateNumber' => $card->birthCertificateNumber,
            'birthCertificateDateOfIssue' => $card->birthCertificateDateOfIssue,
            'registryOffice' => $card->registryOffice,
            'workplace' => $card->workplace,
            'profession' => $card->profession,
            'notation' => $card->notation,
            'last_update' => (new DateTime())->format('Y-m-d H:i:s')
        ]);
        return $result->rowCount() > 0 ?: false;
    }

    public function delete(string $ids): bool
    {
        $query = ("DELETE FROM `patient_cards` WHERE `id` IN ($ids)");
        $result = $this->_connection->prepare($query);
        $result->execute();
        return $result->rowCount() > 0 ?: false;
    }

    public function block(string $cardId, string $accountId) : bool
    {
        $query = ("UPDATE `patient_cards` 
                   SET `owner` = :accountId, `blocked_at` = :blockedAt 
                   WHERE `id` = :cardId");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'cardId' => $cardId,
            'accountId' => $accountId,
            'blockedAt' => (new DateTime())->format('Y-m-d H:i')
        ]);
        return $result->rowCount() > 0 ?: false;
    }

    public function unblock(string $cardId) : bool
    {
        $query = ("UPDATE `patient_cards` 
                   SET `owner` = NULL , `blocked_at` = NULL 
                   WHERE `id` = :cardId");
        $result = $this->_connection->prepare($query);
        $result->execute(['cardId' => $cardId]);
        return $result->rowCount() > 0 ?: false;
    }
}