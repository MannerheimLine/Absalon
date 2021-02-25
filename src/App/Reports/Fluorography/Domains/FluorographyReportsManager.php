<?php

declare(strict_types=1);

namespace Absalon\Application\Reports\Fluorography\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;
use Absalon\Engine\Utility\Converter\Converter;

class FluorographyReportsManager
{
    private IFluorographyReportsDataProvider $_dataProvider;

    public function __construct(IFluorographyReportsDataProvider $dataProvider){
        $this->_dataProvider = $dataProvider;
    }

    public function getPastPatients(string $dateStart, string $dateFinish) : HttpResultContainer
    {
        $data = $this->_dataProvider->getPastPatients($dateStart, $dateFinish);
        $convertedData = [];
        foreach ($data as $key => $value){
            foreach ($value as $recordKey => $recordValue){
                $tempData[Converter::mbUcFirst($recordKey)] = $recordValue;
            }
            $convertedData[$key] = $tempData;
        }
        if (!empty($convertedData)){
            return new HttpResultContainer($convertedData, 200);
        }else{
            return new HttpResultContainer();
        }
    }
}