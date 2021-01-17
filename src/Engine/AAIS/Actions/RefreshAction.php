<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Actions;

use Absalon\Engine\AAIS\Domains\Refresh\Refresh;
use Absalon\Engine\AAIS\Responders\RefreshResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RefreshAction
{
    private $_refresh;
    private $_responder;

    public function __construct(Refresh $refresh, RefreshResponder $responder){
        $this->_refresh = $refresh;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $tokens = $this->_refresh->refresh($request->getAttribute('ValidatedToken'));
        $response = $this->_responder->respond($request, $tokens);
        return $response;
    }

}