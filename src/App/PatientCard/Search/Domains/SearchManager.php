<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

class SearchManager
{
    private ISearchDataProvider $_dataProvider;

    public function __construct(ISearchDataProvider $dataProvider){
        $this->_dataProvider = $dataProvider;
    }

    public function getCards(string $searchString, int $page, int $offset) : HttpResultContainer
    {
        if (!empty($result = $this->_dataProvider->getCards($searchString, $page, $offset))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('Карта(ы) не найдены', 404);
    }

    public function getRegions(string $searchString, int $limit) : HttpResultContainer
    {
        if (!empty($result = $this->_dataProvider->getRegions($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('Регион не найден', 404);
    }

    public function getDistricts(string $searchString, int $limit) : HttpResultContainer
    {
        if (!empty($result = $this->_dataProvider->getDistricts($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('Район не найден', 404);
    }

    public function getLocalities(string $searchString, int $limit) : HttpResultContainer
    {
        if (!empty($result = $this->_dataProvider->getLocalities($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('Населенный пункт не найден', 404);
    }

    public function getStreets(string $searchString, int $limit) : HttpResultContainer
    {
        if (!empty($result = $this->_dataProvider->getStreets($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('Улица не найдена', 404);
    }

    public function getInsuranceCompanies(string $searchString, int $limit) : HttpResultContainer
    {
        if (!empty($result = $this->_dataProvider->getInsuranceCompanies($searchString, $limit))){
            return new HttpResultContainer($result, 200);
        }
        return new HttpResultContainer('Компания не найдена', 404);
    }

}