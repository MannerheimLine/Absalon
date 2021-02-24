<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;
use Absalon\Engine\Utility\Converter\Converter;
use Vulpix\Engine\Core\Utility\Sanitizer\Sanitizer;

/**
 *
 * Class CardManager
 * @package Absalon\Application\PatientCard\Card\Domains
 */
class CardManager
{
    private ICardDataProvider $_dataProvider;

    public function __construct(ICardDataProvider $dataProvider){
        $this->_dataProvider = $dataProvider;
    }

    public function get(string $id) : HttpResultContainer
    {
        try{
            $card = CardFactory::create($this->_dataProvider->get($id));
            if ($card->cardId !== null){
                return new HttpResultContainer($card, 200);
            }
            return new HttpResultContainer('Карта с идентификатором '.$id. ' не найдена на сервере', 204);
        }catch (\Exception $e){
            return new HttpResultContainer('Ошибка произошла при получении карты в CardManager::get()'.$e->getMessage(), 500);
        }
    }

    public function create(CardCreateDTO $cardCreateDTO): HttpResultContainer
    {
        return new HttpResultContainer(['id' => $this->_dataProvider->create($cardCreateDTO)], 201);
    }

    public function update(Card $card) : HttpResultContainer
    {
        try {
            if ($result = $this->_dataProvider->update($card)){
                return new HttpResultContainer($result, 200);
            }
            return new HttpResultContainer("Карта с id ".$card->cardId." не найдена, либо не предоставлена информация для обновления",200);
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
        return new HttpResultContainer("Данные отсутствуют",404);
    }

    public function block(string $cardId, string $accountId) : HttpResultContainer
    {
        $result = $this->_dataProvider->block($cardId, $accountId);
        return new HttpResultContainer($result, 200);

    }

    public function unblock(string $cardId) :HttpResultContainer
    {
        $result = $this->_dataProvider->unblock($cardId);
        return new HttpResultContainer($result, 200);
    }
}