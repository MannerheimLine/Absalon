<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Actions;

use Absalon\Application\Fluorography\Domains\FluorographyManager;
use Absalon\Application\Fluorography\Responders\FluorographiesGetResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FluorographiesGetAction
{
    private FluorographyManager $_manager;
    private $_responder;

    public function __construct(FluorographyManager $manager, FluorographiesGetResponder $responder){
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