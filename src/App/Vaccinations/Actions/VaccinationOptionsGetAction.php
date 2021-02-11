<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Actions;

use Absalon\Application\Vaccinations\Domains\VaccinationManager;
use Absalon\Application\Vaccinations\Responders\VaccinationOptionsGetResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VaccinationOptionsGetAction
{
    private VaccinationManager $_manager;
    private VaccinationOptionsGetResponder $_responder;

    public function __construct(VaccinationManager $manager, VaccinationOptionsGetResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $result = $this->_manager->getOptions();
        $response = $this->_responder->respond($request, $result);
        return $response;
    }

}