<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Actions;

use Absalon\Engine\AAIS\Domains\Authentication\Authentication;
use Absalon\Engine\AAIS\Responders\AuthenticateResponder;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticateAction
{
    private $_authentication;
    private $_responder;

    public function __construct(Authentication $authentication, AuthenticateResponder $responder){
        $this->_authentication = $authentication;
        $this->_responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $credentials = $request->getAttribute('Credentials');
        $tokens = $this->_authentication->authenticate($credentials);
        $response = $this->_responder->respond($request, $tokens);
        return $response;
    }
}