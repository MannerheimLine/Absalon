<?php

declare(strict_types=1);

namespace Absalon\Application\Reports\Fluorography\Actions;

use Absalon\Application\Reports\Fluorography\Domains\FluorographyReportsManager;
use Absalon\Application\Reports\Fluorography\Responders\FluorographyGetPastPatientsResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FluorographyGetPastPatientsAction
{
    private FluorographyReportsManager $_manager;
    private FluorographyGetPastPatientsResponder $_responder;

    public function __construct(FluorographyReportsManager $manager, FluorographyGetPastPatientsResponder $responder){
        $this->_manager = $manager;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $dates);
        $dates = json_decode($dates[0], true);
        $result = $this->_manager->getPastPatients($dates['dateStart'], $dates['dateFinish']);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }

}