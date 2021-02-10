<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Domains;

use Vulpix\Engine\Database\Connectors\IConnector;

class VaccinationMySQLDataProvider implements IVaccinationDataProvider
{
    private \PDO $_connection;

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    public function getAll(string $id) : array
    {
        $query = ("SELECT `v`.`id` AS `vaccinationId`, `v`.`patient_card` AS `patientCardId`,
                   `v`.`vaccination_date` AS `vaccinationDate`, `v`.`vaccination_serial` AS `vaccinationSerial`,
                   `v`.`vaccination_notation` AS `vaccinationNotation`, `v`.`vaccination_dose` AS `vaccinationDoseId`,
                   `vd`.`description` AS `vaccinationDoseName`, `v`.`vaccination_divert` AS `vaccinationDivertId`,
                   `vdi`.`description` AS `vaccinationDivertName`, `v`.`vaccination_injection` AS `vaccinationInjectionId`,
                   `vi`.`description` AS `vaccinationInjectionName`, `v`.`vaccination_type` AS `vaccinationTypeId`,
                   `vt`.`description` AS `vaccinationTypeName` 
                   FROM `vaccinations` `v`
                   LEFT JOIN `vaccination_doses` `vd` ON `v`.`vaccination_dose` = `vd`.`id`
                   LEFT JOIN `vaccination_diverts` `vdi` ON `v`.`vaccination_divert` = `vdi`.`id`
                   LEFT JOIN `vaccination_injections` `vi` ON `v`.`vaccination_injection` = `vi`.`id`
                   LEFT JOIN `vaccination_types` `vt` ON `v`.`vaccination_type` = `vt`.`id`
                   WHERE `patient_card` = :id
                   ORDER BY `vaccinationDate` DESC");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $id]);
        return $result->fetchAll() ?: [];
    }

    public function getOptions(): array
    {
        $query = ("SELECT `vd`.`id` AS `doseId`, `vd`.`description` AS `doseName` FROM `vaccination_doses` `vd`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $doses = $result->fetchAll();
        $query = ("SELECT `vdi`.`id` AS `divertId`, `vdi`.`description` AS `divertName` FROM `vaccination_diverts` `vdi`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $results = $result->fetchAll();
        $query = ("SELECT `vi`.`id` AS `injectionId`, `vi`.`description` AS `injectionName` FROM `vaccination_injections` `vi`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $senders = $result->fetchAll();
        $query = ("SELECT `vt`.`id` AS `typeId`, `vt`.`description` AS `typeName` FROM `vaccination_types` `vt`");
        $result = $this->_connection->prepare($query);
        $result->execute();
        $types = $result->fetchAll();
        return $options = ['doses' => $doses, 'results' =>$results, 'senders' => $senders, 'types' => $types];
    }
}