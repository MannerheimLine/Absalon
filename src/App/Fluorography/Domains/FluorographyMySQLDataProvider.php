<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Domains;

use Vulpix\Engine\Database\Connectors\IConnector;

class FluorographyMySQLDataProvider implements IFluorographyDataProvider
{
    private \PDO $_connection;

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    public function getAll(string $id) : array
    {
        $query = ("SELECT `fluorographies`.`id` AS `fluorographyId`, `fluorographies`.`patient_card` AS `patientCardId`,
                  `fluorography_type` AS `fluorographyTypeId`, 
                  `ft`.`description` AS `fluorographyTypeName`, `fluorography_dose` AS `fluorographyDoseId`, 
                  `fd`.`description` AS `fluorographyDoseName`,  `fluorography_result` AS `fluorographyResultId`, 
                  `fr`.`description` AS `fluorographyResultName`,  `fluorography_number` AS `fluorographyNumber`, 
                  `fluorography_snapshot` AS `fluorographySnapshot`, `fluorography_date` AS `fluorographyDate`, 
                  `fluorography_notation` AS `fluorographyNotation`, `fluorography_sender` AS `fluorographySenderId`, 
                  `fs`.`description` AS `fluorographySenderName`  
                   FROM `fluorographies`
                   LEFT JOIN `fluorography_doses` `fd` ON `fluorographies`.`fluorography_dose` = `fd`.`id`
                   LEFT JOIN `fluorography_results` `fr` ON `fluorographies`.`fluorography_result` = `fr`.`id`
                   LEFT JOIN `fluorography_senders` `fs` on `fluorographies`.`fluorography_sender` = `fs`.`id` 
                   LEFT JOIN `fluorography_types` `ft` on `fluorographies`.`fluorography_type` = `ft`.`id` 
                   WHERE `patient_card` = :id");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $id]);
        return $result->fetchAll() ?: [];
    }

    public function getOptions() : array
    {
        $options = [];
        $query = ("SELECT `fd`.`id` AS `doseId`, `fd`.`description` AS `doseName` FROM `fluorography_doses` `fd`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $doses = $result->fetchAll();
        $query = ("SELECT `fr`.`id` AS `resultId`, `fr`.`description` AS `resultName` FROM `fluorography_results` `fr`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $results = $result->fetchAll();
        $query = ("SELECT `fs`.`id` AS `senderId`, `fs`.`description` AS `senderName` FROM `fluorography_senders` `fs`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $senders = $result->fetchAll();
        $query = ("SELECT `ft`.`id` AS `typeId`, `ft`.`description` AS `typeName` FROM `fluorography_types` `ft`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $types = $result->fetchAll();
        return $options = ['doses' => $doses, 'results' =>$results, 'senders' => $senders, 'types' => $types];
    }

    public function create(FluorographyCreateDTO $DTO) : bool
    {
        $query = ("INSERT INTO `fluorographies` (`id`, `patient_card`, `fluorography_type`, `fluorography_dose`,
                 `fluorography_result`, `fluorography_number`, `fluorography_snapshot`, `fluorography_date`, 
                 `fluorography_sender`, fluorography_notation)
                   
                   VALUES (:fluorographyId, :patientCard, :fluorographyType, :fluorographyDose, :fluorographyResult,
                           :fluorographyNumber, :fluorographySnapshot, :fluorographyDate, :fluorographySender, :fluorographyNotation)");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'fluorographyId' => $DTO->fluorographyId,
            'patientCard' => $DTO->patientCard,
            'fluorographyType' => $DTO->type,
            'fluorographyDose' => $DTO->dose,
            'fluorographyResult' => $DTO->result,
            'fluorographyNumber' => $DTO->number,
            'fluorographySnapshot' => $DTO->snapshot,
            'fluorographyDate' => $DTO->date,
            'fluorographySender' => $DTO->sender,
            'fluorographyNotation' => $DTO->notation
        ]);
        return $result->rowCount() > 0 ?: false;
    }

    public function update(string $id)
    {
        // TODO: Implement update() method.
    }
}