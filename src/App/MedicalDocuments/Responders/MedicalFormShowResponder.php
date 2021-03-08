<?php

declare(strict_types=1);

namespace Absalon\Application\MedicalDocuments\Responders;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class MedicalFormShowResponder
{
    public function respond(ServerRequestInterface $request, $payload = null): Response
    {
        if ($payload->status === 200){
            $response = new HtmlResponse($payload->body->Output('MedicalDocument.pdf', 'S'));
            return $response;
        }else{
            return new JsonResponse($payload->body, $payload->status);
        }
    }
}