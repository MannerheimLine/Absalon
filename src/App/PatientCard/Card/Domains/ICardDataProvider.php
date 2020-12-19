<?php

namespace Absalon\Application\PatientCard\Card\Domains;

interface ICardDataProvider
{
    public function get(string $id) : array;

    public function create(CardCreateDTO $dto) : string;

    public function update(Card $card) : bool;

}