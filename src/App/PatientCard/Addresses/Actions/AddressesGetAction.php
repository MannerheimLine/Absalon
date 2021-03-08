<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Actions;

use Absalon\Application\PatientCard\Addresses\Domains\AddressManager;
use Absalon\Application\PatientCard\Addresses\Responders\AddressesGetResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddressesGetAction
{
    private AddressManager $_manager;
    private AddressesGetResponder $_responder;

    public function __construct(AddressManager $manager, AddressesGetResponder $responder){
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
        $result = $this->_manager->get($request->getAttribute('id'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}