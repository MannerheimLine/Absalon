<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Actions;

use Absalon\Application\Vaccinations\Domains\VaccinationManager;
use Absalon\Application\Vaccinations\Responders\VaccinationUpdateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VaccinationUpdateAction
{
    private VaccinationManager $_manager;
    private VaccinationUpdateResponder $_responder;

    public function __construct(VaccinationManager $manager, VaccinationUpdateResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $result = $this->_manager->update($request->getAttribute('DTO'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}