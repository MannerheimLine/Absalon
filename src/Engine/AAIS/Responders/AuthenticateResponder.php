<?php

declare(strict_types=1);

namespace Absalon\Engine\AAIS\Responders;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticateResponder
{
    public function respond(ServerRequestInterface $request, $payload = null): Response
    {
        return new Response\JsonResponse($payload->body, $payload->status, [], JSON_UNESCAPED_UNICODE); //JSON
    }
}