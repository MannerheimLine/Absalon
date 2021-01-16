<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Account;

use PDO;
use Vulpix\Engine\Database\Connectors\IConnector;

class AccountMySQLDataProvider implements IAccountDataProvider
{
    private PDO $_connection;

    /**
     * CardMySQLDataProvider constructor.
     * @param IConnector $connector
     */
    public function __construct(IConnector $connector){
        $this->_connection = $connector::getConnection();
    }

    public function getAccountDataByUserName(string $userName) : array
    {
        $query = ("SELECT `id` AS `accountId`, `user_name` AS `userName`, `password_hash` AS `passwordHash`,
                   `secret_key` AS `secretKey`, `email`, `created`, `updated` 
                   FROM `user_accounts` WHERE `user_name` =:userName");
        $result = $this->_connection->prepare($query);
        $result->execute(['userName' => $userName]);
        return $result->fetch() ?: [];
    }

}