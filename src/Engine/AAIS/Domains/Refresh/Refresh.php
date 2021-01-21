<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Refresh;

use Absalon\Engine\AAIS\Domains\Account\AccountManager;
use Absalon\Engine\AAIS\Domains\Tokens\TokensService;
use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;

class Refresh
{
    private $_accountManager;
    private $_tokensService;

    public function __construct(AccountManager $accountManager, TokensService $tokensService)
    {
        $this->_accountManager = $accountManager;
        $this->_tokensService = $tokensService;
    }

    public function refresh(string $token) : HttpResultContainer
    {
        if ($accountId = $this->_tokensService->validateRefreshToken($token)){
            $account = $this->_accountManager->getAccountById($accountId);
            if ($account->accountId){
                $accessToken = $this->_tokensService->createAccessToken($account);
                $refreshToken = $this->_tokensService->createRefreshToken($account);
                return new HttpResultContainer(['AccessToken' => $accessToken, 'RefreshToken' => $refreshToken], 200);
            }
            return new HttpResultContainer('Такой учетной записи не существует в системе', 401);
        }
        return new HttpResultContainer('Вам необходима аутентификация', 401);
    }

}