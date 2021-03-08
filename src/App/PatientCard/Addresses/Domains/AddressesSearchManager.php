<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Domains;

use Absalon\Application\PatientCard\Addresses\Domains\DataProviders\IAddressSearchDataProvider;
use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

class AddressesSearchManager
{
    private IAddressSearchDataProvider $_dataProvider;

    public function __construct(IAddressSearchDataProvider $dataProvider)
    {
        $this->_dataProvider = $dataProvider;
    }

    private function getRegions(string $searchString, int $limit){
        if (!empty($result = $this->_dataProvider->getRegions($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('По запросу '.$searchString.' данные не найдены', 204);
    }

    private function getDistricts(string $searchString, int $limit){
        if (!empty($result = $this->_dataProvider->getDistricts($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('По запросу '.$searchString.' данные не найдены', 204);
    }

    private function getLocalities(string $searchString, int $limit){
        if (!empty($result = $this->_dataProvider->getLocalities($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('По запросу '.$searchString.' данные не найдены', 204);
    }

    private function getStreets(string $searchString, int $limit){
        if (!empty($result = $this->_dataProvider->getStreets($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('По запросу '.$searchString.' данные не найдены', 204);
    }

    public function search(string $target, string $searchString, int $limit){
        switch ($target){
            case 'regions' : return $this->getRegions($searchString, $limit);
            case 'districts' : return $this->getDistricts($searchString, $limit);
            case 'localities' : return $this->getLocalities($searchString, $limit);
            case 'streets' : return $this->getStreets($searchString, $limit);
        }
    }

}