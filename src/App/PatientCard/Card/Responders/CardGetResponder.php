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
        if (!$payload->body->id){
            return new Response\JsonResponse('Карта с идентификатором '.$request->getAttribute('id'). ' не найдена на сервере', 404);
        }
        return new Response\JsonResponse($payload->body, $payload->status); //JSON
    }

}