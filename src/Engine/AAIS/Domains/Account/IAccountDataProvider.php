<?php


namespace Absalon\Engine\AAIS\Domains\Account;


interface IAccountDataProvider
{
    public function getAccountDataByUserName(string $userName) : array;

}