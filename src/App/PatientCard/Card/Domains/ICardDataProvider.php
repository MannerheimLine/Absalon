<?php

namespace Absalon\Application\PatientCard\Card\Domains;

interface ICardDataProvider
{
    public function get(string $id) : array;

    public function create(CardCreateDTO $dto) : string;

    public function update(Card $card) : bool;

    public function delete(string $ids) : bool;

    public function block(string $cardId, string $accountId) : bool;

    public function unblock(string $cardId) : bool;

}