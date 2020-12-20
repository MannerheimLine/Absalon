<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Actions;

use Absalon\Application\PatientCard\Card\Domains\CardManager;
use Absalon\Application\PatientCard\Card\Responders\CardCreateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CardCreateAction
{
    private CardManager $_cardManager;
    private CardCreateResponder $_responder;

    public function __construct(CardManager $cardManager, CardCreateResponder $responder){
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
        $result = $this->_cardManager->create($request->getAttribute('DTO'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}