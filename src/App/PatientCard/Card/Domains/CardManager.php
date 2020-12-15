<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

class CardManager
{
    public function createCard(){
        $card = new Card(1, 'Иванов', 'Юрий', 1234567887654321, 12345678911);
        return $card;
    }

}