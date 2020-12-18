<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

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
        if ($card->id !== null){
            return new HttpResultContainer($card, 200);
        }
        return new HttpResultContainer('Карта с идентификатором '.$id. ' не найдена на сервере', 404);
    }

    public function create(CardCreateDTO $cardCreateDTO): HttpResultContainer
    {
        return new HttpResultContainer($this->_dataProvider->create($cardCreateDTO), 201);
    }

    public function update(int $id) : int {

    }

    public function delete(int $id){

    }

    public function block(int $id){

    }

    public function unblock(int $id){

    }

}