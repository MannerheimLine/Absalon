<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Actions;

use Absalon\Application\Fluorography\Domains\FluorographyManager;
use Absalon\Application\Fluorography\Responders\FluorographyDeleteResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FluorographyDeleteAction
{
    private FluorographyManager $_manager;
    private FluorographyDeleteResponder $_responder;

    public function __construct(FluorographyManager $manager, FluorographyDeleteResponder $responder){
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