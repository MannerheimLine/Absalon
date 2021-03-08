<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Actions;

use Absalon\Application\PatientCard\Addresses\Domains\AddressesSearchManager;
use Absalon\Application\PatientCard\Addresses\Responders\AddressSearchResponder;
use Psr\Http\Message\ServerRequestInterface;

class AddressSearchAction
{
    private AddressesSearchManager $_manager;
    private AddressSearchResponder $_responder;

    public function __construct(AddressesSearchManager $manager, AddressSearchResponder $responder)
    {
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request){
        $searchString = $request->getAttribute('ValidatedData')['searchString'];
        $limit = $request->getAttribute('ValidatedData')['limit'];
        $target = $request->getAttribute('ValidatedData')['target'];
        $result = $this->_manager->search($target, $searchString, $limit);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}