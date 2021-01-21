<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Tokens;

use PDO;
use Vulpix\Engine\Database\Connectors\IConnector;

class TokensMySQLDataProvider implements ITokensDataProvider
{
    private PDO $_connection;

    public function __construct(IConnector $connector)
    {
        $this->_connection = $connector::getConnection();
    }

    public function getToken(string $token) : array
    {
        $query = ("SELECT `account_id` AS `accountId`, `refresh_token` AS `refreshToken`, `created`, `expires`
                   FROM `refresh_tokens` WHERE `refresh_token` = :refreshToken ");
        $result = $this->_connection->prepare($query);
        $result->execute(['refreshToken' => $token]);
        return $result->fetch() ?: [];
    }

    public function insertToken(string $token, string $accountId): void
    {
        $query = ("INSERT INTO `refresh_tokens` (`account_id`, `refresh_token`, `created`, `expires`)
                   VALUES (:accountId, :refreshToken, :created, :expires)");
        $result = $this->_connection->prepare($query);
        $result->execute([
            'accountId' => $accountId,
            'refreshToken' => $token,
            'created' => time(),
            'expires' => time() + 60*60*24*30
        ]);
    }

    public function deleteToken(string $accountId): void
    {
        $query = ("DELETE FROM `refresh_tokens` WHERE `account_id` = :accountId");
        $result = $this->_connection->prepare($query);
        $result->execute(['accountId' => $accountId]);
    }
}