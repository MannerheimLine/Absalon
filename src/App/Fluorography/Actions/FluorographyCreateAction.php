<?php


namespace Absalon\Application\Fluorography\Actions;


use Absalon\Application\Fluorography\Domains\FluorographyManager;
use Absalon\Application\Fluorography\Responders\FluorographyCreateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FluorographyCreateAction
{
    private FluorographyManager $_manager;
    private FluorographyCreateResponder $_responder;

    public function __construct(FluorographyManager $manager, FluorographyCreateResponder $responder){
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