<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Account;

class AccountManager
{
    private $_dataProvider;

    public function __construct(IAccountDataProvider $dataProvider)
    {
        $this->_dataProvider = $dataProvider;
    }

    public function getAccountById(string $accountId) : Account
    {
        $accountData = $this->_dataProvider->getAccountDataById($accountId);
        return AccountFactory::create($accountData);
    }

    public function getAccountByUserName(string $userName) : Account
    {
        $accountData = $this->_dataProvider->getAccountDataByUserName($userName);
        return AccountFactory::create($accountData);
    }


}