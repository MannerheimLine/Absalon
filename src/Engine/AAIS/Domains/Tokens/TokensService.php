<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Domains\Tokens;

use Absalon\Engine\AAIS\Domains\Account\Account;
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

class TokensService
{
    private $_dataProvider;
    private $_jwtPayload;
    private string $_keyStorage;

    public function __construct(ITokensDataProvider $dataProvider, JWTPayload $jwtPayload)
    {
        $this->_dataProvider = $dataProvider;
        $this->_jwtPayload = $jwtPayload;
        $this->_keyStorage = 'storage';
    }

    private function generateSecretKeyFile(string $secretKey, string $accountId) : bool
    {
        $fileName = $this->_keyStorage.'/'.$accountId;
        if (file_exists($fileName)){
            unlink($fileName);
        }
        if($keyFile = fopen($fileName, 'w')){
            fwrite($keyFile, $secretKey);
            fclose($keyFile);
            return true;
        }
        return false;
    }

    /**
     * Каждый раз при создании токена, для пользователя будет генерироваться секретный ключ
     * Ключ записывается в хранилище в специальный файл.
     * Имя файла это уникальный идентификатор пользователя.
     * Теперь каждый раз, когда нужно расшифровать токен, ключ будет браться из файла.
     * Если на момент создания токена, уже существует файл с секретным ключем, он пересоздается.
     *
     * Создание и хранение файлов секретных ключей решате проблему подделки токенов:
     * 1) Алгоритм создания токена очень простой. Используя его токен можно создать  в любой php песочнице
     * 2) Но для расшифровки сигнатуры этого токена, может быть использован только секретный ключ, который создается и
     * хранится на сервере.
     * 3) Ключ этот уникален на основе uuid4 и подделать его не имеется возможности, так же на сервер нет возможности
     * из вне отправить поддельный файл ключа для расшифровки этого токена, а значит если на сервер
     * будет отправлен подделаный токен, он просто не расшифруется серверным ключем(конкретного пользователя)
     * И тем самым не даст возможность получить неавторизованному лицу контроль.
     */
    private function generateSecretKey(Account $account) : string
    {
        $uuid = Uuid::uuid4()->toString();
        $secretKey = hash('sha1',$uuid.$account->userName, false);
        $result = $this->generateSecretKeyFile($secretKey, $account->accountId);
        if (!$result){
            throw new \RuntimeException('Создать файл секретного ключа для пользователя '.$account->userName.' не получилось');
        }
        return $secretKey;
    }

    /**
     * Данные о привелегиях пользователя хранятся в токене.
     * Привелегии передаются на сервер в токене и проверяются только после проверки подписи токена.
     * Если токен и его подпись валидны, значит мидлвар передает далее на сервер список привелегий пользователя
     * Если подпись не прошла проверку пользователь отправляется на страницу аутентификации
     * Данные о пользовательских привелегиях должны храниться в токене.
     * При такоем подходе, нельзя подделать привелеги в токене ибо подпись сразу будет являтся не валидной,
     * а значит пользователь будет обладать только теми привелегиями которые ему выдал сервер
     *
     * При обновлении пользователя, например при выдаче ему новых привелегий. Обязательно нужно делать ему
     * принудительную ре-аутентификацию, дабы обновить токен новыми привелегиями
     *
     */
    public function createAccessToken(Account $account) : string
    {
        $secretKey = $this->generateSecretKey($account);
        $this->_jwtPayload->setAccountId($account->accountId);
        $this->_jwtPayload->setPermissions(['GET_CARD', 'GET_CARDS']);
        $this->_jwtPayload->setTalons(['ambulatory', 'emergency', 'gynecology']);
        return JWT::encode($this->_jwtPayload, $secretKey);
    }

    private function insertRefreshToken(string $token, string $accountId) : void
    {
        $this->_dataProvider->insertToken($token, $accountId);
    }

    private function deleteRefreshToken(string $accountId) : void
    {
        $this->_dataProvider->deleteToken($accountId);
    }

    public function createRefreshToken(Account $account) : string
    {
        $this->deleteRefreshToken($account->accountId);
        $token = Uuid::uuid4()->toString();
        $this->insertRefreshToken($token, $account->accountId);
        return $token;
    }

    public function validateRefreshToken(string $token) : string|bool
    {
        /**
         * 1 - найти токен в БД
         * - если токена нет в БД для данного пользователя, то отправить ответ со ссылкой на аутентификацию
         * - если токен есть, то проверить его время годности
         * -- если время годности закончено, то отправить ответ со ссылкой на аутентификацию
         * -- если время годности не закончено то:
         * 2 - создать пару из аксес и рефрешь токена и отправить их в ответ
         */
        if ($result = $this->_dataProvider->getToken($token)){
            $currentTime = time();
            if ($currentTime < $result['expires']){
                return $result['accountId'];
            }
            return false;
        }
        return false;
    }

}