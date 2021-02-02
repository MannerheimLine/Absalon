<?php

declare(strict_types=1);

namespace Absalon\Application\Fluorography\Actions;

use Absalon\Application\Fluorography\Domains\FluorographyManager;
use Absalon\Application\Fluorography\Responders\FluorographyOptionsGetResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FluorographyOptionsGetAction
{
    private $_manager;
    private FluorographyOptionsGetResponder $_responder;

    public function __construct(FluorographyManager $manager, FluorographyOptionsGetResponder $responder)
    {
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