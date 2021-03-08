<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Actions;

use Absalon\Application\PatientCard\Addresses\Domains\AddressesFactory;
use Absalon\Application\PatientCard\Addresses\Domains\AddressManager;
use Absalon\Application\PatientCard\Addresses\Responders\AddressCreateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddressCreateAction
{
    private AddressManager $_manager;
    private AddressCreateResponder $_responder;

    public function __construct(AddressManager $manager, AddressCreateResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $data = json_decode(file_get_contents("php://input"),true) ?: [];
        $dto = AddressesFactory::createDTO($data);
        $result = $this->_manager->create($dto);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }

}