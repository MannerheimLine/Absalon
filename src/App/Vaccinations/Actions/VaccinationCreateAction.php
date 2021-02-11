<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Actions;

use Absalon\Application\Vaccinations\Domains\VaccinationManager;
use Absalon\Application\Vaccinations\Responders\VaccinationCreateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VaccinationCreateAction
{
    private VaccinationManager $_manager;
    private VaccinationCreateResponder $_responder;

    public function __construct(VaccinationManager $manager, VaccinationCreateResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $result = $this->_manager->create($request->getAttribute('DTO'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}