<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Actions;

use Absalon\Application\PatientCard\Card\Domains\CardManager;
use Absalon\Application\PatientCard\Card\Responders\CardDeleteResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CardDeleteAction
{
    private CardManager $_cardManager;
    private CardDeleteResponder $_responder;

    public function __construct(CardManager $cardManager, CardDeleteResponder $responder){
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
        $incomingIds = json_decode(file_get_contents("php://input"),true) ?: [];
        $result = $this->_cardManager->delete($incomingIds);
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}