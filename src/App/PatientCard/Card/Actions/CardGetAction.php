<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Actions;

use Absalon\Application\PatientCard\Card\Domains\CardManager;
use Absalon\Application\PatientCard\Card\Responders\CardGetResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CardGetAction
{
    private CardManager $_cardManager;
    private CardGetResponder $_responder;

    public function __construct(CardManager $cardManager, CardGetResponder $responder){
        $this->_cardManager = $cardManager;
        $this->_responder = $responder;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $result = $this->_cardManager->get($request->getAttribute('id'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}