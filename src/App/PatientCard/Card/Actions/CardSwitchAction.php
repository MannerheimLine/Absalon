<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Actions;

use Absalon\Application\PatientCard\Card\Domains\CardManager;
use Absalon\Application\PatientCard\Card\Responders\CardSwitchResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CardSwitchAction
{
    private CardManager $_cardManager;
    private CardSwitchResponder $_responder;

    public function __construct(CardManager $cardManager, CardSwitchResponder $cardBlockResponder){
        $this->_cardManager = $cardManager;
        $this->_responder = $cardBlockResponder;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $cardId = json_decode(file_get_contents("php://input"),true)['cardId'] ?: [];
        $accountId = ($request->getAttribute('AccountId'));
        if ($request->getHeader('Switch-Card')[0] === 'on'){
            $result = $this->_cardManager->block($cardId, $accountId);
        }else{
            $result = $this->_cardManager->unblock($cardId);
        }
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}