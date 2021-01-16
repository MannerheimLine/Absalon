<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Services\Tokens;

use Absalon\Engine\Exceptions\UnknownPropertyException;

class JWTPayload implements \JsonSerializable
{
    private string $_issuer;
    private string $_subject;
    private string $_audience;
    private int $_expires;
    private int $_notBefore;
    private int $_issuedAt;
    private string $_jwtId;
    private string $_accountId;
    private array $_accountPermissions = [];
    private array $_talons = [];

    public function __construct()
    {
        $tokenConfigs = include_once 'configs/token.php';
        $this->init($tokenConfigs);
    }

    private function init(array $tokenConfigs) : void
    {
        foreach ($tokenConfigs as $key => $value){
            if (property_exists($this, $property ='_'.($key))){
                $this->$property = $value;
            }else{
                throw new UnknownPropertyException("Свойство ".$property." не найдено в классе ".get_class($this));
            }
        }
    }

    public function setAccountId(string $accountId) : void
    {
        $this->_accountId = $accountId;
    }

    public function setPermissions(array $permissions) : void
    {
        $this->_accountPermissions = $permissions;
    }

    public function setTalons(array $talons) : void
    {
        $this->_talons = $talons;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        return [
            'iss' => $this->_issuer,
            'sub' => $this->_subject,
            'aud' => $this->_audience,
            'exp' => $this->_expires,
            'nbf' => $this->_notBefore,
            'iat' => $this->_issuedAt,
            'jti' => $this->_jwtId,
            'accountId' => $this->_accountId,
            'accountPermissions' => $this->_accountPermissions,
            'talons' => $this->_talons
        ];
    }
}