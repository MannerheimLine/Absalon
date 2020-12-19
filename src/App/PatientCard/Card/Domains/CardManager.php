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
        $card = CardFactory::create($this->_dataProvider->get($id));
        if ($card->cardId !== null){
            return new HttpResultContainer($card, 200);
        }
        return new HttpResultContainer('Карта с идентификатором '.$id. ' не найдена на сервере', 404);
    }

    public function create(CardCreateDTO $cardCreateDTO): HttpResultContainer
    {
        return new HttpResultContainer(['id' => $this->_dataProvider->create($cardCreateDTO)], 201);
    }

    public function update(Card $card) : HttpResultContainer
    {
        return new HttpResultContainer($this->_dataProvider->update($card), 200);
    }

    public function delete(array $ids) : HttpResultContainer
    {
        $ids = Sanitizer::sanitize($ids);
        $ids = Converter::arrayToQuotedString($ids);
        if ($this->_dataProvider->delete($ids)){
            return new HttpResultContainer($this->_dataProvider->delete($ids),204);
        }
        return new HttpResultContainer("Данные отсутствуют",404);
    }

    public function block(int $id){

    }

    public function unblock(int $id){

    }

}