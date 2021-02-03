<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

class FluorographyManager
{
    private IFluorographyDataProvider $_dataProvider;

    public function __construct(IFluorographyDataProvider $dataProvider)
    {
        $this->_dataProvider = $dataProvider;
    }

    public function getAll(string $id) : HttpResultContainer
    {
        $data = $this->_dataProvider->getAll($id);
        $records = [];
        $i = 0;
        if (!empty($data)){
            foreach ($data as $record){
                $records[$i] = FluorographyFactory::create($record);
                $i++;
            }
            return new HttpResultContainer($records, 200);
        }
        return new HttpResultContainer('Для текущей карты не найдено ниодного исследования');
    }

    public function getOptions() : HttpResultContainer
    {
        $data = $this->_dataProvider->getOptions();
        if (!empty($data)) {
            return new HttpResultContainer($data, 200);
        }
        return new HttpResultContainer('Для текущей карты не найдено ниодного исследования');
    }

    public function create(FluorographyCreateDTO $DTO) : HttpResultContainer
    {
        if ($result = $this->_dataProvider->create($DTO)){
            return new HttpResultContainer($result, 201);
        }
        return new HttpResultContainer('Проблема вызвана в процессе вставки записи в БД', 500);
    }
}