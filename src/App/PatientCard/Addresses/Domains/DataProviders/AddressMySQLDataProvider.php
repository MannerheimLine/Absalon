<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Domains\DataProviders;

use Absalon\Application\PatientCard\Addresses\Domains\DataStructures\Address;
use PDO;
use Vulpix\Engine\Database\Connectors\IConnector;

class AddressMySQLDataProvider implements IAddressDataProvider
{
    private PDO $_connection;

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    public function get(string $id) : array
    {
        $query = ("SELECT `pca`.`id` AS `addressId`, `pca`.`patient_card` AS `patientCardId`,
                   `pcat`.`id` AS `addressTypeId`, `pcat`.`id` AS `addressTypeId`, `pcat`.`type_system_name` AS `addressTypeSystemName`,
                   `pcat`.`type_name` AS `addressTypeName`, `regions`.`region_id` AS `regionId`, `regions`.`region_name` AS `regionName`,
                   `districts`.`district_id` AS `districtId`, `districts`.`district_name` AS `districtName`,
                   `localities`.`locality_id` AS `localityId`, `localities`.`locality_name` AS `localityName`,   
                   `streets`.`street_id` AS `streetId`, `streets`.`street_name` AS `streetName` , `house_number` AS `houseNumber`, 
                   `apartment`       
                   FROM `patient_cards_addresses` as `pca` 
                   INNER JOIN `patient_cards_addresses_types` pcat ON `pca`.`address_type` = `pcat`.`id` 
                   LEFT JOIN `regions` ON `pca`.`region` = `regions`.`region_id` 
                   LEFT JOIN `districts` ON `pca`.`district` = `districts`.`district_id` 
                   LEFT JOIN `localities` ON `pca`.`locality` = `localities`.`locality_id` 
                   LEFT JOIN `streets` ON `pca`.`street` = `streets`.`street_id`
                   WHERE `patient_card` = :id");
        $result = $this->_connection->prepare($query);
        $result->execute(['id' => $id]);
        return $result->fetchAll() ?: [];
    }

    public function create(Address $address) : bool
    {
        $query = ("INSERT INTO `patient_cards_addresses` (id, patient_card, address_type, region, district, locality, street, house_number, apartment)
                   VALUES (:addressId, :patientCardId, :addressType, :region, :district, :locality,
                           :street, :houseNumber, :apartment)");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'addressId' => $address->addressId,
            'patientCardId' => $address->patientCardId,
            'addressType' => $address->addressTypeId,
            'region' => $address->regionId,
            'district' => $address->districtId,
            'locality' => $address->localityId,
            'street' => $address->streetId,
            'houseNumber' => $address->houseNumber,
            'apartment' => $address->apartment

        ]);
        return $result->rowCount() > 0 ?: false;
    }

    public function update(Address $address) : bool
    {
        $query = ("UPDATE `patient_cards_addresses`
                   SET 
                   `address_type` = :addressTypeId,
                   `region` = :regionId,
                   `district` = :districtId,
                   `locality` = :localityId,
                   `street` = :streetId,
                   `house_number` = :houseNumber,
                   `apartment` = :apartment
                   WHERE `id` = :addressId");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'addressId' => $address->addressId,
            'addressTypeId' => $address->addressTypeId,
            'regionId' => $address->regionId,
            'districtId' => $address->districtId,
            'localityId' => $address->localityId,
            'streetId' => $address->streetId,
            'houseNumber' => $address->houseNumber,
            'apartment' => $address->apartment
        ]);
        return $result->rowCount() > 0 ?: false;
    }

    public function delete(array $ids): bool
    {
        $query = ("DELETE FROM `patient_cards_addresses` WHERE `id` IN ($ids)");
        $result = $this->_connection->prepare($query);
        $result->execute();
        return $result->rowCount() > 0 ?: false;
    }
}