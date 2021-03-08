<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Addresses\Responders;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class AddressesGetResponder
{
    /**
     * @param ServerRequestInterface $request
     * @param null $payload
     * @return Response
     */
    public function respond(ServerRequestInterface $request, $payload = null): Response
    {
        if(!empty($payload)){
            return new Response\JsonResponse($payload, 200, [], JSON_UNESCAPED_UNICODE); //JSON
        }
        return new Response\JsonResponse($payload, 204, [], JSON_UNESCAPED_UNICODE); //JSON
    }
}