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
    private ICardDataProvider $dataProvider;

    public function __construct(ICardDataProvider $dataProvider){
        $this->dataProvider = $dataProvider;
    }

    public function get(string $id) : HttpResultContainer
    {
        return new HttpResultContainer($this->dataProvider->get($id), 200);
    }

    public function update(int $id) : int {

    }

    public function create(CardCreateDTO $cardCreateDTO){

    }

    public function delete(int $id){

    }

    public function block(int $id){

    }

    public function unblock(int $id){

    }

}