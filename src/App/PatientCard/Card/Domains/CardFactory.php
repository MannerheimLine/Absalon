<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Domains;

class CardFactory
{
    public static function create(array|bool $data) : Card
    {
        $card = new Card();
        if($data){
            $card->id = $data['cardId'];
            unset($data['cardId']);
            foreach ($data as $name => $value){
                $card->$name = $value;
            }
        }
        return $card;
    }

}