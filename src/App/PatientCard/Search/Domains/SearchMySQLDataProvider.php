<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Domains;

use Vulpix\Engine\Database\Connectors\IConnector;

/**
 * Повторяющиееся и почти схожие методы для поиска диспозиций, сделаны лишь для чистоты
 *
 * Class SearchMySQLDataProvider
 * @package Absalon\Application\PatientCard\Search\Domains
 */
class SearchMySQLDataProvider implements ISearchDataProvider
{
    private \PDO $_connection;

    /**
     * SearchMySQLDataProvider constructor.
     * @param IConnector $connector
     */
    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    /**
     * @param string $word
     * @param int $page
     * @param int $offset
     * @return array
     */
    public function getCards(string $word, int $page, int $offset) : array
    {
        $query = ("SELECT `id` AS `cardId`, `card_number` AS `cardNumber`, `surname`, `first_name` AS `firstName`, 
                   `second_name` AS `secondName`, `policy_number` AS `policyNumber`, 
                   `insurance_certificate` AS `insuranceCertificate`
                   FROM `patient_cards`
                   WHERE `card_number` LIKE '%$word%' OR `policy_number` LIKE '%$word%' OR `insurance_certificate` LIKE '%$word%' OR CONCAT(`surname`, ' ', `first_name`) 
                   LIKE '%$word%'");
        $result = $this->_connection->prepare($query);
        $result->execute();
        if ($result->rowCount() > 0){
            return Paginator::paginate($result->fetchAll(), $page, $offset);
        }
        return [];
    }

    public function getRegions(string $word, int $limit) : array
    {
        $query =("SELECT * FROM `regions` WHERE `region_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $regions = [];
        while ($row = $result->fetch()){
            $regions[$i]['RegionId'] = $row['id'];
            $regions[$i]['RegionName'] = $row['region_name'];
            $i++;
        }
        return $regions;
    }

    public function getDistricts(string $word, int $limit) : array
    {
        $query =("SELECT * FROM `districts` WHERE `district_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $districts = [];
        while ($row = $result->fetch()){
            $districts[$i]['DistrictId'] = $row['id'];
            $districts[$i]['DistrictName'] = $row['district_name'];
            $i++;
        }
        return $districts;
    }

    public function getLocalities(string $word, int $limit) : array
    {
        $query =("SELECT * FROM `localities` WHERE `locality_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $localities = [];
        while ($row = $result->fetch()){
            $localities[$i]['LocalityId'] = $row['id'];
            $localities[$i]['LocalityName'] = $row['locality_name'];
            $i++;
        }
        return $localities;
    }

    public function getStreets(string $word, int $limit) : array
    {
        $query =("SELECT * FROM `streets` WHERE `street_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $streets = [];
        while ($row = $result->fetch()){
            $streets[$i]['StreetId'] = $row['id'];
            $streets[$i]['StreetName'] = $row['street_name'];
            $i++;
        }
        return $streets;
    }

    public function getInsuranceCompanies(string $word, int $limit) : array
    {
        $query =("SELECT * FROM `insurance_companies` WHERE `insurance_company_name` LIKE '%$word%' LIMIT :limit");
        $result = $this->_connection->prepare($query);
        $result->execute(['limit' => $limit]);
        $i = 0;
        $streets = [];
        while ($row = $result->fetch()){
            $streets[$i]['InsuranceCompanyId'] = $row['id'];
            $streets[$i]['InsuranceCompanyName'] = $row['insurance_company_name'];
            $i++;
        }
        return $streets;
    }
}