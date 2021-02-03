<?php


namespace Absalon\Application\Fluorography\Responders;


use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class FluorographyCreateResponder
{
    public function respond(ServerRequestInterface $request, $payload = null): Response
    {
        return new Response\JsonResponse($payload->body, $payload->status, [], JSON_UNESCAPED_UNICODE); //JSON
    }
}