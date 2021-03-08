<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Domains\DataProviders;

use PDO;
use Vulpix\Engine\Database\Connectors\IConnector;

class AddressSearchMySQLDataProvider implements IAddressSearchDataProvider
{
    private PDO $_connection;

    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    public function getRegions(string $word, int $limit): array
    {
        $query = ("SELECT * FROM `regions` WHERE `region_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $data = [];
        while ($row = $result->fetch()){
            $data[$i]['RegionId'] = $row['region_id'];
            $data[$i]['RegionName'] = $row['region_name'];
            $i++;
        }
        return $data;
    }

    public function getDistricts(string $word, int $limit): array
    {
        $query = ("SELECT `region_id`, `region_name`, `district_id`, `district_name`
                    FROM `districts`
                    INNER JOIN `regions` r ON `districts`.`parent` = `r`.`region_id`
                    WHERE `district_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $data = [];
        while ($row = $result->fetch()){
            $data[$i]['RegionId'] = $row['region_id'];
            $data[$i]['RegionName'] = $row['region_name'];
            $data[$i]['DistrictId'] = $row['district_id'];
            $data[$i]['DistrictName'] = $row['district_name'];
            $i++;
        }
        return $data;
    }

    public function getLocalities(string $word, int $limit): array
    {
        $query = ("SELECT `region_id`, `region_name`, `district_id`, `district_name`, `locality_id`, `locality_name`
                    FROM `localities`
                    INNER JOIN `districts` d ON `localities`.`parent` = `d`.`district_id`
                    INNER JOIN `regions` r ON `d`.`parent` = `r`.`region_id`
                    WHERE `locality_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $data = [];
        while ($row = $result->fetch()){
            $data[$i]['RegionId'] = $row['region_id'];
            $data[$i]['RegionName'] = $row['region_name'];
            $data[$i]['DistrictId'] = $row['district_id'];
            $data[$i]['DistrictName'] = $row['district_name'];
            $data[$i]['LocalityId'] = $row['locality_id'];
            $data[$i]['LocalityName'] = $row['locality_name'];
            $i++;
        }
        return $data;
    }

    public function getStreets(string $word, int $limit): array
    {
        $query = ("SELECT * FROM `streets` WHERE `street_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $streets = [];
        while ($row = $result->fetch()){
            $streets[$i]['StreetId'] = $row['street_id'];
            //$streets[$i]['StreetPrefix'] = $row['street_prefix'];
            $streets[$i]['StreetName'] = $row['street_name'];
            $i++;
        }
        return $streets;
    }
}