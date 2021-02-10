<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Actions;

use Absalon\Application\Vaccinations\Domains\VaccinationManager;
use Absalon\Application\Vaccinations\Responders\VaccinationsGetResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VaccinationsGetAction
{
    private VaccinationManager $_manager;
    private VaccinationsGetResponder $_responder;

    public function __construct(VaccinationManager $manager, VaccinationsGetResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $result = $this->_manager->getAll($request->getAttribute('id'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }

}