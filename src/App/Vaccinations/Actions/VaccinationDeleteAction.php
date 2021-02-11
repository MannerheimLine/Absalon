<?php

declare(strict_types=1);

namespace Absalon\Application\Vaccinations\Actions;

use Absalon\Application\Vaccinations\Domains\VaccinationManager;
use Absalon\Application\Vaccinations\Responders\VaccinationDeleteResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VaccinationDeleteAction
{
    private VaccinationManager $_manager;
    private VaccinationDeleteResponder $_responder;

    public function __construct(VaccinationManager $manager, VaccinationDeleteResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $incomingIds = json_decode(file_get_contents("php://input"),true) ?: [];
        $result = $this->_manager->delete($incomingIds);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}