<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Actions;

use Absalon\Application\PatientCard\Card\Domains\CardManager;
use Absalon\Application\PatientCard\Card\Responders\CardUpdateResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CardUpdateAction
{
    private CardManager $_cardManager;
    private CardUpdateResponder $_responder;

    public function __construct(CardManager $cardManager, CardUpdateResponder $responder){
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
        $result = $this->_cardManager->update($request->getAttribute('DTO'));
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}