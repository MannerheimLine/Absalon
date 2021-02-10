<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

class VaccinationManager
{
    private IVaccinationDataProvider $_dataProvider;

    public function __construct(IVaccinationDataProvider $dataProvider){
        $this->_dataProvider = $dataProvider;
    }

    public function getAll(string $id) : HttpResultContainer
    {
        $data = $this->_dataProvider->getAll($id);
        $records = [];
        $i = 0;
        if (!empty($data)){
            foreach ($data as $record){
                $records[$i] = VaccinationFactory::create($record);
                $i++;
            }
            return new HttpResultContainer($records, 200);
        }
        return new HttpResultContainer('Для текущей карты не найдено ниодного исследования');
    }

    public function getOptions() : HttpResultContainer
    {
        $data = $this->_dataProvider->getOptions();
        return new HttpResultContainer($data, 200);
    }
}