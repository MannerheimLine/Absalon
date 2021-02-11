<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Actions;

use Absalon\Application\Fluorography\Domains\FluorographyManager;
use Absalon\Application\Fluorography\Responders\FluorographyUpdateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FluorographyUpdateAction
{
    private FluorographyManager $_manager;
    private FluorographyUpdateResponder $_responder;

    public function __construct(FluorographyManager $manager, FluorographyUpdateResponder $responder){
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