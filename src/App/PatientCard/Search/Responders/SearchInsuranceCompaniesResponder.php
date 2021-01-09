<?php

declare(strict_types=1);

namespace Absalon\Application\PatientCard\Search\Responders;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class SearchInsuranceCompaniesResponder
{
    public function respond(ServerRequestInterface $request, $payload = null): Response
    {
        return new Response\JsonResponse($payload->body, $payload->status); //JSON
    }
}