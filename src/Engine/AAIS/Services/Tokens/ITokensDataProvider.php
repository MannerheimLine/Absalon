<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Services\Tokens;

interface ITokensDataProvider
{
    public function getToken(string $token) : array;

    public function insertToken(string $token, string $accountId) : void;

    public function deleteToken(string $accountId) : void;

}