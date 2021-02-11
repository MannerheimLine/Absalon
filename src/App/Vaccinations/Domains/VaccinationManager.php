<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;
use Absalon\Engine\Utility\Converter\Converter;
use Vulpix\Engine\Core\Utility\Sanitizer\Sanitizer;

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

    public function create(Vaccination $vaccination) : HttpResultContainer
    {
        if ($result = $this->_dataProvider->create($vaccination)){
            return new HttpResultContainer($result, 201);
        }
        return new HttpResultContainer('Проблема вызвана в процессе вставки записи в БД', 500);
    }

    public function update(Vaccination $vaccination) : HttpResultContainer
    {
        try {
            if ($result = $this->_dataProvider->update($vaccination)){
                return new HttpResultContainer($result, 200);
            }
            return new HttpResultContainer("Запись с id ".$vaccination->vaccinationId." не найдена, либо обновления не были учтены",200);
        }catch (\Exception $e){
            return new HttpResultContainer($e->getMessage(), 500);
        }
    }

    public function delete(array $ids) : HttpResultContainer
    {
        $ids = Sanitizer::sanitize($ids);
        $ids = Converter::arrayToQuotedString($ids);
        if ($result = $this->_dataProvider->delete($ids)){
            return new HttpResultContainer($result,204);
        }
        return new HttpResultContainer("Данные отсутствуют");
    }
}