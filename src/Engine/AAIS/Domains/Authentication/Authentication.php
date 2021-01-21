<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Authentication;

use Absalon\Engine\AAIS\Domains\Account\AccountManager;
use Absalon\Engine\AAIS\Domains\Tokens\TokensService;
use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

class Authentication
{
    private AccountManager $_manager;
    private TokensService $_tokensService;

    public function __construct(AccountManager $manager, TokensService $tokensService)
    {
        $this->_manager = $manager;
        $this->_tokensService = $tokensService;
    }

    public function authenticate(Credentials $credentials) : HttpResultContainer
    {
        $account = $this->_manager->getAccountByUserName($credentials->userName);
        if ($account->accountId){
            $hash = $account->passwordHash;
            if (password_verify($credentials->userPassword, $hash)){
                $accessToken = $this->_tokensService->createAccessToken($account);
                $refreshToken = $this->_tokensService->createRefreshToken($account);
                return new HttpResultContainer(['AccessToken' => $accessToken, 'RefreshToken' => $refreshToken], 200);
            }
            return new HttpResultContainer('Пароль не верен', 401);
        }
        return new HttpResultContainer('Такой учетной записи не существует в системе', 401);
    }

}