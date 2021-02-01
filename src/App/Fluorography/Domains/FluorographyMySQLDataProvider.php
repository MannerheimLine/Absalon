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
                  `fluorographies`.`card_number` AS `patientCardNumber`, `fluorography_type` AS `fluorographyTypeId`, 
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

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update(string $id)
    {
        // TODO: Implement update() method.
    }
}