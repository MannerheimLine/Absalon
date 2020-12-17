<?php

namespace Absalon\Application\PatientCard\Card\Domains;

interface ICardDataProvider
{
    public function get(string $id) : Card;

}