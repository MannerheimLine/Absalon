<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Card\Responders;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class CardGetResponder
{
    /**
     * @param ServerRequestInterface $request
     * @param null $payload
     * @return Response
     */
    public function respond(ServerRequestInterface $request, $payload = null): Response
    {
        return new Response\JsonResponse($payload); //JSON
    }

}