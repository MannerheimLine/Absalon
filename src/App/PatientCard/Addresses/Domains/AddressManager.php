<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Domains;

use Absalon\Application\PatientCard\Addresses\Domains\DataProviders\AddressMySQLDataProvider;
use Absalon\Application\PatientCard\Addresses\Domains\DataStructures\Address;
use Absalon\Engine\DataStructures\TransferContainers\HttpResultContainer;
use Ramsey\Uuid\Uuid;

class AddressManager
{
    private $_dataProvider;

    public function __construct(AddressMySQLDataProvider $dataProvider)
    {
        $this->_dataProvider = $dataProvider;
    }

    public function get(string $id) : array
    {
        $addresses = $this->_dataProvider->get($id);
        return AddressesFactory::create($addresses);
    }

    public function create(Address $address) : HttpResultContainer
    {
        $address->addressId = Uuid::uuid4()->toString();
        if ($result = $this->_dataProvider->create($address)){
            return new HttpResultContainer($address->addressId, 201);
        }
        return new HttpResultContainer('Проблема вызвана в процессе вставки записи в БД', 500);
    }

    public function update(Address $address) : HttpResultContainer
    {
        $result = $this->_dataProvider->update($address);
        return new HttpResultContainer($result, 200);
    }

}