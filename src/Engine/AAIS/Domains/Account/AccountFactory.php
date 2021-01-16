<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Account;

class AccountFactory
{
    public static function create(array $accountData) : Account
    {
        $account = new Account();
        if ($accountData) {
            foreach ($accountData as $name => $value){
                $account->$name = $value;
            }
        }
        return $account;
    }

}