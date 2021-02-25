<?php

declare(strict_types=1);

namespace Absalon\Application\Reports\Fluorography\Domains;

use Vulpix\Engine\Database\Connectors\IConnector;

class FluorographyReportsMySQLDataProvider implements IFluorographyReportsDataProvider
{
    private \PDO $_connection;

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    public function getPastPatients(string $dateStart, string $dateFinish) : array
    {
        $query = ("SELECT `cards`.`surname` AS `surname`, `cards`.`first_name` AS `firstName`, 
                   `cards`.`second_name` AS `secondName`, `cards`.`card_number` AS `cardNumber`,
                   `fr`.`description` AS `fluorographyResult`, `fluorographies`.`fluorography_snapshot` AS `fluorographySnapshot`,
                    `fluorographies`.`fluorography_date` AS `fluorographyDate`
                   FROM `patient_cards` AS `cards`
                   INNER JOIN `fluorographies` ON `cards`.`id` = `fluorographies`.`patient_card` 
                   INNER JOIN `fluorography_results` fr ON `fluorographies`.`fluorography_result` = `fr`.`id`
                   WHERE `fluorographies`.`fluorography_date` BETWEEN :dateStart AND :dateFinish");
        $result = $this->_connection->prepare($query);
        $result->execute(['dateStart' => $dateStart, 'dateFinish' => $dateFinish]);
        return $result->fetchAll() ?: [];
    }
}