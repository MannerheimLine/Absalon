<?php

declare(strict_types=1);

namespace Absalon\Application\Talons\Actions;

use Absalon\Application\Talons\Domains\Talon;
use Absalon\Application\Talons\Responders\TalonShowResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TalonShowAction
{
    private Talon $_talon;
    private TalonShowResponder $_responder;

    public function __construct(Talon $talon, TalonShowResponder $responder){
        $this->_talon = $talon;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $incomingData = ['cardId'=>$request->getAttribute('id'), 'talon'=>$request->getAttribute('talon')];
        $result = $this->_talon->init($incomingData)->makePdf();
        $response = $this->_responder->respond($request, $result);
        return $response;
    }
}